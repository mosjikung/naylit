<template>
<div class="q-pa-xs">

    <div class="row q-col-gutter-xs q-gutter-y-lg">
        <div class="col-md-12">

            <q-table :grid="$q.screen.xs" class="my-sticky-column-table" dense title="" :data="data" :columns="columns" row-key="KEYID" :pagination.sync="pagination" :loading="loading" :filter="filter" @request="onRequest" binary-state-sort>
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
                        <q-td key="SO_NO" :props="props"> {{ props.row.SO_NO }}</q-td>
                        <q-td key="LINE_ID" :props="props"> {{ props.row.LINE_ID }}</q-td>
                        <q-td key="SO_NO_DATE" :props="props"> {{ props.row.SO_NO_DATE }}</q-td>
                        <q-td key="CUSTOMER_ID" :props="props"> {{ props.row.CUSTOMER_ID }}</q-td>
                        <q-td key="CUSTOMER_NAME" :props="props"> {{ props.row.CUSTOMER_NAME }}</q-td>
                        <q-td key="CUSTOMER_PO" :props="props"> {{ props.row.CUSTOMER_PO }}</q-td>
                        <q-td key="END_BUYER" :props="props"> {{ props.row.END_BUYER }}</q-td>
                        <q-td key="SALE_ID" :props="props"> {{ props.row.SALE_ID }}</q-td>
                        <q-td key="SALE_NAME" :props="props"> {{ props.row.SALE_NAME }}</q-td>
                        <q-td key="TEAM_NAME" :props="props"> {{ props.row.TEAM_NAME }}</q-td>
                        <q-td key="ITEM_CODE" :props="props"> {{ props.row.ITEM_CODE }}</q-td>
                        <q-td key="ITEM_DESC" :props="props"> {{ props.row.ITEM_DESC }}</q-td>
                        <q-td key="COLOR_CODE" :props="props"> {{ props.row.COLOR_CODE }}</q-td>
                        <q-td key="COLOR_DESC" :props="props"> {{ props.row.COLOR_DESC }}</q-td>
                        <q-td key="PLAN_MPS_ID" :props="props"> {{ props.row.PLAN_MPS_ID }}</q-td>
                        <q-td key="PLAN_FGWEEK_IN_WH" :props="props"> {{ props.row.PLAN_FGWEEK_IN_WH }}</q-td>
                        <q-td key="LOADDYE_WEEK" :props="props"> {{ props.row.LOADDYE_WEEK }}</q-td>
                        <q-td key="SOLINE_QTY" :props="props"> {{ props.row.SOLINE_QTY }}</q-td>
                        <q-td key="MPS_PLAN_KG" :props="props">{{ props.row.MPS_PLAN_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="PO_RM_PURCHASE" :props="props"> {{ props.row.PO_RM_PURCHASE }}</q-td>
                        <q-td key="RM_SHIP_DATE" :props="props"> {{ props.row.RM_SHIP_DATE }}</q-td>
                        <q-td key="RM_SHIP_KG" :props="props">{{ props.row.RM_SHIP_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="MPS_MC_NO" :props="props"> {{ props.row.MPS_MC_NO }}</q-td>
                        <q-td key="OU_CODE" :props="props"> {{ props.row.OU_CODE }}</q-td>
                        <q-td key="BATCH_NO" :props="props"> {{ props.row.BATCH_NO }}</q-td>
                        <q-td key="BATCH_ROLL" :props="props">{{ props.row.BATCH_ROLL| numeral('0,0') }}</q-td>
                        <q-td key="BATCH_KG" :props="props">{{ props.row.BATCH_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="STEP_WIP_AGEING" :props="props"> {{ props.row.STEP_WIP_AGEING }}</q-td>
                        <q-td key="MPS_WIP_STEP" :props="props"> {{ props.row.MPS_WIP_STEP }}</q-td>
                        <q-td key="AGEING_DAY" :props="props">{{ props.row.AGEING_DAY| numeral('0,0') }}</q-td>
                        <q-td key="START_AGEING_DATE" :props="props"> {{ props.row.START_AGEING_DATE }}</q-td>
                        <q-td key="WIP_LOSS_KG" :props="props">{{ props.row.WIP_LOSS_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="WIP_LOSS_PERCENT" :props="props">{{ props.row.WIP_LOSS_PERCENT| numeral('0,0.00') }}</q-td>
                        <q-td key="BAL_WAIT_FG_REC" :props="props">{{ props.row.BAL_WAIT_FG_REC| numeral('0,0.00') }}</q-td>
                        <q-td key="FG_START_REC_DATE" :props="props"> {{ props.row.FG_START_REC_DATE }}</q-td>
                        <q-td key="FG_REC_KG" :props="props">{{ props.row.FG_REC_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="FG_SHIP_KG" :props="props">{{ props.row.FG_SHIP_KG| numeral('0,0.00') }}</q-td>
                        <q-td key="FG_LAST_SHIP_DATE" :props="props"> {{ props.row.FG_LAST_SHIP_DATE }}</q-td>
                        <q-td key="BAL_WAIT_FG_SHIP" :props="props">{{ props.row.BAL_WAIT_FG_SHIP| numeral('0,0.00') }}</q-td>
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
    props: ["EVENT", "PARAM", "DTE"],
    data() {
        return {
            filter: '',
            loading: false,
            pagination: {
                sortBy: 'SO_NO',
                descending: false,
                page: 1,
                rowsPerPage: 10,
                rowsNumber: 1
            },
            columns: [{
                    name: 'SO_NO',
                    required: true,
                    label: 'SO No.',
                    align: 'left',
                    field: row => row.SO_NO,
                    sortable: true
                },
                {
                    name: 'LINE_ID',
                    align: 'center',
                    label: 'Line',
                    field: 'LINE_ID',
                    sortable: false
                },
                {
                    name: 'SO_NO_DATE',
                    align: 'center',
                    label: 'SO Date',
                    field: 'SO_NO_DATE',
                    sortable: false
                },
                {
                    name: 'CUSTOMER_ID',
                    label: 'Cus. ID',
                    field: 'CUSTOMER_ID',
                    align: 'center',
                    sortable: true
                },
                {
                    name: 'CUSTOMER_NAME',
                    label: 'Cus. Name',
                    field: 'CUSTOMER_NAME',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'CUSTOMER_PO',
                    label: 'Cus. PO',
                    field: 'CUSTOMER_PO',
                    align: 'left',
                    sortable: true,
                    //sort: (a, b) => parseInt(a, 10) - parseInt(b, 10)
                },
                {
                    name: 'END_BUYER',
                    label: 'End Buyer',
                    field: 'END_BUYER',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'SALE_ID',
                    label: 'Sales ID',
                    field: 'SALE_ID',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'SALE_NAME',
                    label: 'Sales Name',
                    field: 'SALE_NAME',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'TEAM_NAME',
                    label: 'Team Name',
                    field: 'TEAM_NAME',
                    align: 'left',
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
                    name: 'ITEM_DESC',
                    label: 'Item Des.',
                    field: 'ITEM_DESC',
                    align: 'left',
                    sortable: true
                },

                {
                    name: 'COLOR_CODE',
                    label: 'Color Code',
                    field: 'COLOR_CODE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'COLOR_DESC',
                    label: 'Color Desc.',
                    field: 'COLOR_DESC',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'PLAN_MPS_ID',
                    label: 'Plan ID',
                    field: 'PLAN_MPS_ID',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'PLAN_FGWEEK_IN_WH',
                    label: 'Plan FG Wk.',
                    field: 'PLAN_FGWEEK_IN_WH',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'LOADDYE_WEEK',
                    label: 'Load Wk.',
                    field: 'LOADDYE_WEEK',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'SOLINE_QTY',
                    label: 'Order Qty.',
                    field: 'SOLINE_QTY',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'MPS_PLAN_KG',
                    label: 'MPS Plan KGS.',
                    field: 'MPS_PLAN_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'PO_RM_PURCHASE',
                    label: 'PO RM Purchase',
                    field: 'PO_RM_PURCHASE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'RM_SHIP_DATE',
                    label: 'RM Ship Date',
                    field: 'RM_SHIP_DATE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'RM_SHIP_KG',
                    label: 'Ship KGS.',
                    field: 'RM_SHIP_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'MPS_MC_NO',
                    label: 'M/C No.',
                    field: 'MPS_MC_NO',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'OU_CODE',
                    label: 'OU Code',
                    field: 'OU_CODE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'BATCH_NO',
                    label: 'Batch No.',
                    field: 'BATCH_NO',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'BATCH_ROLL',
                    label: 'Batch Rolls',
                    field: 'BATCH_ROLL',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'BATCH_KG',
                    label: 'Batch KGS.',
                    field: 'BATCH_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'STEP_WIP_AGEING',
                    label: 'Step WIP Aging',
                    field: 'STEP_WIP_AGEING',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'MPS_WIP_STEP',
                    label: 'WIP Status',
                    field: 'MPS_WIP_STEP',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'START_AGEING_DATE',
                    label: 'Start Aging Date',
                    field: 'START_AGEING_DATE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'AGEING_DAY',
                    label: 'Aging Days',
                    field: 'AGEING_DAY',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'WIP_LOSS_KG',
                    label: 'WIP Loss KGS.',
                    field: 'WIP_LOSS_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'WIP_LOSS_PERCENT',
                    label: 'WIP LOSS %',
                    field: 'WIP_LOSS_PERCENT',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'BAL_WAIT_FG_REC',
                    label: 'Bal. Wait FG Rec.',
                    field: 'BAL_WAIT_FG_REC',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'FG_START_REC_DATE',
                    label: 'Start FG Date',
                    field: 'FG_START_REC_DATE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'FG_REC_KG',
                    label: 'FG Rec.',
                    field: 'FG_REC_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'FG_SHIP_KG',
                    label: 'FG Ship KGS.',
                    field: 'FG_SHIP_KG',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'FG_LAST_SHIP_DATE',
                    label: 'Last FG Ship',
                    field: 'FG_LAST_SHIP_DATE',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'BAL_WAIT_FG_SHIP',
                    label: 'Bal. Wait FG Ship',
                    field: 'BAL_WAIT_FG_SHIP',
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
            params.append("event", this.EVENT)
            params.append("param", this.PARAM)
            params.append("dte", this.DTE)

            await axios({
                method: "post",
                url: this.$api + "dashboard.php/wip",
                data: params
            }).then(res => {
                //console.log(res.data)
                count = res.data.totalrow
                this.data = res.data.data

                this.pagination.rowsNumber = count
                this.pagination.page = page
                this.pagination.rowsPerPage = rowsPerPage
                this.pagination.sortBy = sortBy
                this.pagination.descending = descending
                this.loading = false
            });
        },
        async onExport() {

            let params = new FormData();
            params.append("filter", this.filter);
            params.append("event", this.EVENT)
            params.append("param", this.PARAM)
            params.append("dte", this.DTE)
            await axios({
                method: "post",
                url: this.$api + "dashboard.php/export_wip",
                data: params
            }).then(res => {
                console.log(res.data)
                this.excel = res.data
                const dataWS = XLSX.utils.json_to_sheet(this.excel)
                const wb = XLSX.utils.book_new()
                XLSX.utils.book_append_sheet(wb, dataWS)
                XLSX.writeFile(wb, 'export_wip.xlsx')
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
