<template>
<div class="q-pa-md">
    <div class="row q-col-gutter-xs ">
        <div class="col-md-2">

            <q-field label="WIP Date" stack-label dense>
                <template v-slot:control>
                    <div class="self-center full-width no-outline" tabindex="0">{{date}}</div>
                </template>
                <template v-slot:append>
                    <q-icon name="event" class="cursor-pointer">
                        <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
                            <q-date v-model="date" :options="DteOptions" @input="() => $refs.qDateProxy.hide()" />
                        </q-popup-proxy>
                    </q-icon>
                </template>
            </q-field>

        </div>
        <div class="col-md-2">
            <q-btn round size="sm" icon="search" color="primary" glossy @click="QueryData">
                <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
                    Search
                </q-tooltip>
            </q-btn>
            &nbsp;
            <q-btn round size="sm" class="text-capitalize glossy" color="primary" label="Excel" @click="onExport">
                <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
                    Export Excel
                </q-tooltip>
            </q-btn>
        </div>
    </div>
    <div class="row q-col-gutter-xs q-gutter-y-lg">
        <div class="col-md-12">

            <q-table class="my-sticky-column-table" title="" dense :data="data" :columns="columns" row-key="name" separator="cell" :pagination.sync="pagination">
                <template v-slot:header="props">
                    <q-tr :props="props">
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Load Dye</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">FG Week</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">SO No.</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Item Code</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Color Description</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Schedule ID</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Grey In</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">M/C No.</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Order Qty.</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Last Batch No.</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Batch Step</q-th>

                        <q-th colspan="9" style="text-align:center;border:1px solid silver;">Status</q-th>
                        <q-th rowspan="2" style="text-align:center;border:1px solid silver;">Total</q-th>
                    </q-tr>
                    <q-tr :props="props">
                        <q-th style="text-align:center;border:1px solid silver;">1. No Fab</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">2. W.Pull</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">3. W.Fab</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">4. W.Batch</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">5. DPS</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">6. DH WIP</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">7. CLOSED</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">8. CANCELLED</q-th>
                        <q-th style="text-align:center;border:1px solid silver;">9. HOLD</q-th>
                    </q-tr>
                </template>

                <q-td slot="body-cell-LOADDYE_WEEK" slot-scope="props" :props="props">
                    <span class="opendetail" @click="OpenDetail('LOADWEEK',props.value)">{{props.value}}</span>
                </q-td>
                <q-td slot="body-cell-PLAN_FGWEEK_IN_WH" slot-scope="props" :props="props">
                    <span class="opendetail" @click="OpenDetail('FGWEEK',props.value)">{{props.value}}</span>
                </q-td>
                <q-td slot="body-cell-SO_NO" slot-scope="props" :props="props">
                    <span class="opendetail" @click="OpenDetail('SO',props.value)">{{props.value}}</span>
                </q-td>

                <template v-slot:bottom-row="props">
                    <q-tr :props="props" v-for="i in sumfooter" :key="i.KEYS">
                        <q-td style="text-align:center;border:1px solid silver;" class="opendetail"><span @click="OpenDetail('','')">Total</span></q-td>
                        <q-td colspan="10" style="text-align:right;border:1px solid silver;"></q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP01|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP02|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP03|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP04|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP05|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP06|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP07|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP08|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.STEP09|numeral('0,0.00')}}</q-td>
                        <q-td style="text-align:right;border:1px solid silver;">{{i.TOTAL|numeral('0,0.00')}}</q-td>

                    </q-tr>
                </template>

            </q-table>

        </div>
    </div>

    <q-dialog v-model="popup" full-width full-height persistent>
        <q-card>
            <q-bar>
                <div>Drill Down</div>
                <q-space />
                <q-btn dense flat icon="close" v-close-popup>
                    <q-tooltip>Close</q-tooltip>
                </q-btn>
            </q-bar>
            <q-card-section>
                <WIP :EVENT="EVENT" :PARAM="PARAM" :DTE="date" v-show="popup"></WIP>
            </q-card-section>
        </q-card>
    </q-dialog>

</div>
</template>

<script>
import WIP from '@/components/wip.vue'
import axios from "axios"
import XLSX from 'xlsx'

export default {
    components: {
        WIP
    },
    data() {
        return {
            EVENT: '',
            PARAM: '',
            popup: false,
            date: null,
            DteOptions: [],
            filter: '',
            loading: false,
            pagination: {
                sortBy: 'LOADDYE_WEEK',
                descending: false,
                page: 1,
                rowsPerPage: 10
            },
            columns: [{
                    name: 'LOADDYE_WEEK',
                    required: true,
                    label: 'Load Dye',
                    align: 'left',
                    field: row => row.LOADDYE_WEEK,
                    sortable: true
                },
                {
                    name: 'PLAN_FGWEEK_IN_WH',
                    align: 'center',
                    label: 'FG Week',
                    field: 'PLAN_FGWEEK_IN_WH',
                    sortable: true
                },
                {
                    name: 'SO_NO',
                    align: 'left',
                    label: 'SO No.',
                    field: 'SO_NO',
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
                    name: 'COLOR_DESC',
                    label: 'Color Description',
                    field: 'COLOR_DESC',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'PLAN_MPS_ID',
                    label: 'Schedule ID',
                    field: 'PLAN_MPS_ID',
                    align: 'left',
                    sortable: true,
                    //sort: (a, b) => parseInt(a, 10) - parseInt(b, 10)
                },
                {
                    name: 'GREY_IN_DATE',
                    label: 'Grey In',
                    field: 'GREY_IN_DATE',
                    align: 'center',
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
                    name: 'SOLINE_QTY',
                    label: 'Order Qty.',
                    field: 'SOLINE_QTY',
                    align: 'right',
                    sortable: true
                },
                {
                    name: 'BATCH_NO',
                    label: 'Last Batch No.',
                    field: 'BATCH_NO',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'STEP_WIP_AGEING',
                    label: 'Batch Step',
                    field: 'STEP_WIP_AGEING',
                    align: 'left',
                    sortable: true
                },
                {
                    name: 'STEP01',
                    label: '1. No Fab',
                    field: 'STEP01',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP02',
                    label: '2. W.Pull',
                    field: 'STEP02',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP03',
                    label: '3. W.Fab',
                    field: 'STEP03',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP04',
                    label: '4. W.Batch',
                    field: 'STEP04',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP05',
                    label: '5. DPS',
                    field: 'STEP05',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP06',
                    label: '6. DH WIP',
                    field: 'STEP06',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP07',
                    label: '7. CLOSED',
                    field: 'STEP07',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP08',
                    label: '8. CANCELLED',
                    field: 'STEP08',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'STEP09',
                    label: '9. HOLD',
                    field: 'STEP09',
                    align: 'right',
                    sortable: false
                },
                {
                    name: 'TOTAL',
                    label: 'Total',
                    field: 'TOTAL',
                    align: 'right',
                    sortable: false
                }

            ],
            data: [],
            sumfooter: []

        }
    },
    mounted() {
        console.log("New Mouted WIP")
        this.InitData();
        // this.onRequest({
        //     pagination: this.pagination,
        //     filter: ""
        // })
    },
    methods: {
        async InitData() {
            let params = new FormData();

            await axios({
                method: "post",
                url: this.$api + "dashboard.php/back5days",
                data: params
            }).then(res => {
                this.date = res.data.curdate
                this.DteOptions = res.data.dates
                this.QueryData()
            });
        },
        async QueryData() {

            let params = new FormData()
            params.append("dte", this.date)
            // params.append("fetchCount", fetchCount)
            // params.append("filter", filter)
            // params.append("sortBy", sortBy)
            // params.append("descending", descending)
            await axios({
                method: "post",
                url: this.$api + "dashboard.php/wip_summary",
                data: params
            }).then(res => {
                //console.log(res.data.summary)
                //count = res.data.totalrow
                this.data = res.data.rows
                this.sumfooter = res.data.summary

                // this.pagination.rowsNumber = count
                // this.pagination.page = page
                // this.pagination.rowsPerPage = rowsPerPage
                // this.pagination.sortBy = sortBy
                // this.pagination.descending = descending
                // this.loading = false
            });

            // this.onRequest({
            //     pagination: this.pagination,
            //     filter: ""
            // })
        },
        async onExport() {
            window.open('http://peoplefinder.nanyangtextile.com/service/NAYLIT/ExportWIP.ashx' + '?wipDte=' + this.date);
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
            params.append("dte", this.date)
            // params.append("fetchCount", fetchCount)
            // params.append("filter", filter)
            // params.append("sortBy", sortBy)
            // params.append("descending", descending)
            await axios({
                method: "post",
                url: this.$api + "dashboard.php/wip_summary",
                data: params
            }).then(res => {
                //console.log(res.data)
                //count = res.data.totalrow
                this.data = res.data

                // this.pagination.rowsNumber = count
                // this.pagination.page = page
                // this.pagination.rowsPerPage = rowsPerPage
                // this.pagination.sortBy = sortBy
                // this.pagination.descending = descending
                // this.loading = false
            });
        },
        OpenDetail(Event, params) {
           
            this.EVENT = Event
            this.PARAM = params
            this.popup = true

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

.opendetail {
    text-decoration: underline;
    color: blue;
    cursor: pointer;
}
</style>
