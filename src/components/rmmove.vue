<template>
<div class="q-pa-md">
    <!-- <div class="row q-col-gutter-xs ">
        <div class="col-md-2">
            <q-btn icon="search" color="deep-orange" glossy label="Search" @click="QueryData" />
        </div>
    </div> -->
    <div class="row q-col-gutter-xs q-gutter-y-lg">
        <div class="col-md-12">

            <q-table :grid="$q.screen.xs" class="my-sticky-column-table" dense title="" :data="data" :columns="columns" row-key="id" :pagination.sync="pagination" :loading="loading" :filter="filter" @request="onRequest" binary-state-sort>
                <template v-slot:top-right>
                    <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
                        <template v-slot:append>
                            <q-icon style="cursor:pointer;" name="search" />
                        </template>
                    </q-input>
                    <q-btn round size="sm" class="text-capitalize glossy" color="primary" label="Excel" @click="onExport">
                        <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
                            Export Excel
                        </q-tooltip>
                    </q-btn>
                </template>
                <template v-slot:body="props">
                    <q-tr :props="props">
                        <q-td key="PO_NO" :props="props"> {{ props.row.PO_NO }}</q-td>
                        <q-td key="PO_LINE" :props="props"> {{ props.row.PO_LINE }}</q-td>
                        <q-td key="PO_DATE" :props="props"> {{ props.row.PO_DATE }}</q-td>
                        <q-td key="ITEM_CODE" :props="props"> {{ props.row.ITEM_CODE }}</q-td>
                        <q-td key="REC_RM_TYPE" :props="props"> {{ props.row.REC_RM_TYPE }}</q-td>
                        <q-td key="LOCATOR_ID" :props="props"> {{ props.row.LOCATOR_ID }}</q-td>
                        <q-td key="REC_RM_KG" :props="props">{{ props.row.REC_RM_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="RESERVE_RM_KG" :props="props">{{ props.row.RESERVE_RM_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="ISSUE_RM_KG" :props="props">{{ props.row.ISSUE_RM_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="BALANCE_RM_KG" :props="props">{{ props.row.BALANCE_RM_KG| numeral('0,0.00') }}</q-td>
                    </q-tr>
                </template>
            </q-table>

        </div>
    </div>

</div>
</template>

<script>
import axios from "axios"
import XLSX from 'xlsx'
export default {

    data() {
        return {
            filter: '',
            loading: false,
            pagination: {
                sortBy: 'PO_NO',
                descending: false,
                page: 1,
                rowsPerPage: 10,
                rowsNumber: 10
            },
            columns: [{
                    name: 'PO_NO',
                    required: true,
                    label: 'PO No.',
                    align: 'left',
                    field: row => row.PO_NO,
                    sortable: true
                },
                {
                    name: 'PO_LINE',
                    align: 'center',
                    label: 'Line',
                    field: 'PO_LINE',
                    sortable: false
                },
                {
                    name: 'PO_DATE',
                    label: 'PO Date',
                    field: 'PO_DATE',
                    align: 'center',
                    sortable: true
                },
                {
                    name: 'ITEM_CODE',
                    label: 'Item Code',
                    field: 'ITEM_CODE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'REC_RM_TYPE',
                    label: 'RM Type',
                    field: 'REC_RM_TYPE',
                    align: 'left',
                    sortable: true
                    //sort: (a, b) => parseInt(a, 10) - parseInt(b, 10)
                },
                {
                    name: 'LOCATOR_ID',
                    label: 'Locator',
                    field: 'LOCATOR_ID',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'REC_RM_KG',
                    label: 'Receive KGS.',
                    field: 'REC_RM_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'RESERVE_RM_KG',
                    label: 'Reserve KGS.',
                    field: 'RESERVE_RM_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'ISSUE_RM_KG',
                    label: 'Issue KGS.',
                    field: 'ISSUE_RM_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'BALANCE_RM_KG',
                    label: 'Balance KGS.',
                    field: 'BALANCE_RM_KG',
                    align: 'right',
                    sortable: true
                }
            ],
            data: []
        }
    },
    mounted() {
        this.onRequest({
            pagination: this.pagination,
            filter: ""
        })
    },
    methods: {

        QueryData() {

            this.onRequest({
                pagination: this.pagination,
                filter: ""
            })

        },
        async onExport() {
            console.log(this.filter)

            let params = new FormData();
            params.append("filter", this.filter);

            await axios({
                method: "post",
                url: this.$api + "dashboard.php/export_rmmove",
                data: params
            }).then(res => {
                //console.log(res.data)
                this.excel = res.data
                const dataWS = XLSX.utils.json_to_sheet(this.excel)
                const wb = XLSX.utils.book_new()
                XLSX.utils.book_append_sheet(wb, dataWS)
                XLSX.writeFile(wb, 'export_rmmove.xlsx')
            });

        },
        async onRequest(props) {
            this.loading = true
            let {
                page,
                rowsPerPage,
                rowsNumber,
                sortBy,
                descending
            } = props.pagination

            let fetchCount = rowsPerPage === 0 ? rowsNumber : rowsPerPage

            let startRow = (page - 1) * rowsPerPage

            let filter = props.filter
            let count = 0
            let _result = []
            let params = new FormData()
            params.append("startRow", startRow)
            params.append("fetchCount", fetchCount)
            params.append("filter", filter)
            params.append("sortBy", sortBy)
            params.append("descending", descending)
            await axios({
                method: "post",
                url: this.$api + "dashboard.php/rm_move",
                data: params
            }).then(res => {
                count = res.data.totalrow
                this.data = res.data.data

                this.pagination.rowsNumber = count
                this.pagination.page = page
                this.pagination.rowsPerPage = rowsPerPage
                this.pagination.sortBy = sortBy
                this.pagination.descending = descending
                this.loading = false
            });
        }
    }
}
</script>

<style scoped>
.my-sticky-column-table {

    max-width: 100%;
}

.my-sticky-column-table>>>thead tr:first-child {
    background-color: #fff
}

.my-sticky-column-table>>>thead th:first-child {
    background-color: #fff
}

.my-sticky-column-table>>>td:first-child {
    background-color: #f5f5dc;
}

.my-sticky-column-table>>>th:first-child {
    position: sticky;
    left: 0;
    z-index: 1;
}

.my-sticky-column-table>>>td:first-child {
    position: sticky;
    left: 0;
    z-index: 1;
}
</style>
