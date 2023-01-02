<template>
<div class="q-pa-xs">

  <div class="row q-col-gutter-xs q-gutter-y-lg">
    <div class="col-md-2 col-sm-2 col-xs-3">
      <q-input v-model="sono" label="SO No." stack-label dense />

    </div>
    <div class="col-md-2 col-sm-2 col-xs-3">

      <q-field label="Rec. Date From" stack-label dense>
        <template v-slot:control>
          <div class="self-center full-width no-outline" tabindex="0">{{dteS}}</div>
        </template>
        <template v-slot:append>
          <q-icon name="event" class="cursor-pointer">
            <q-popup-proxy ref="qDateProxyS" transition-show="scale" transition-hide="scale">
              <q-date v-model="dteS" @input="() => $refs.qDateProxyS.hide()" />
            </q-popup-proxy>
          </q-icon>
        </template>
      </q-field>

    </div>
    <div class="col-md-2 col-sm-2 col-xs-3">

      <q-field label="Rec. Date To" stack-label dense>
        <template v-slot:control>
          <div class="self-center full-width no-outline" tabindex="0">{{dteE}}</div>
        </template>
        <template v-slot:append>
          <q-icon name="event" class="cursor-pointer">
            <q-popup-proxy ref="qDateProxyE" transition-show="scale" transition-hide="scale">
              <q-date v-model="dteE" @input="() => $refs.qDateProxyE.hide()" />
            </q-popup-proxy>
          </q-icon>
        </template>
      </q-field>

    </div>
    <div class="col-md-2  col-xs-3">
      <q-btn round size="sm" icon="search" color="primary" glossy @click="QueryData">
        <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
          Search
        </q-tooltip>
      </q-btn>
      <q-btn round size="sm" class="text-capitalize glossy q-ml-xs" color="primary" label="Excel" @click="onExport">
        <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
          Export Excel
        </q-tooltip>
      </q-btn>
    </div>
  </div>

  <div class="row q-col-gutter-xs q-gutter-y-lg">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <q-table dense title="" :data="datas" :columns="columns" row-key="PL_NO" separator="cell" :pagination.sync="pagination" :table-header-style="{ backgroundColor: '#4d88ff',color:'white' }" />
    </div>
  </div>

</div>
</template>

<script>
import XLSX from 'xlsx'

export default {
  props: ["EVENT", "PARAM", "DTE"],
  data() {
    return {
      sono: '',
      dteS: '',
      dteE: '',
      datas: [],
      excel: null,
      pagination: {
        sortBy: 'RECEIVE_DATE',
        descending: false,
        page: 1,
        rowsPerPage: 15
      },
      columns: [{
          name: 'LOC_NO',
          field: 'LOC_NO',
          label: 'LOC_NO',
          align: 'left',
          sortable: true
        },
        {
          name: 'RECEIVE_DATE',
          field: 'RECEIVE_DATE',
          label: 'FG_FINISH_DATE',
          align: 'center',
          sortable: true
        },
        {
          name: 'SALE_ID',
          field: 'SALE_ID',
          label: 'SALE_ID',
          align: 'left',
          sortable: true
        },
        {
          name: 'SALE_NAME',
          field: 'SALE_NAME',
          label: 'SALE_NAME',
          align: 'left',
          sortable: true
        },
        {
          name: 'CUSTOMER_ID',
          field: 'CUSTOMER_ID',
          label: 'CUSTOMER_ID',
          align: 'left',
          sortable: true
        },
        {
          name: 'CUSTOMER_NAME',
          field: 'CUSTOMER_NAME',
          label: 'CUSTOMER_NAME',
          align: 'left',
          sortable: true
        },
        {
          name: 'SO_NO',
          field: 'SO_NO',
          label: 'SO_NO',
          align: 'left',
          sortable: true
        },
        {
          name: 'PO_NO',
          field: 'PO_NO',
          label: 'PO_NO',
          align: 'left',
          sortable: true
        },
        {
          name: 'BATCH_NO',
          field: 'BATCH_NO',
          label: 'BATCH_NO',
          align: 'left',
          sortable: true
        },
        {
          name: 'PL_NO',
          field: 'PL_NO',
          label: 'PL_NO',
          align: 'left',
          sortable: true
        },
        {
          name: 'ITEM_NYF',
          field: 'ITEM_NYF',
          label: 'ITEM_CODE',
          align: 'left',
          sortable: true
        },
        {
          name: 'ITEM_NYF_DESC',
          field: 'ITEM_NYF_DESC',
          label: 'ITEM_DESC',
          align: 'left',
          sortable: true
        },
        {
          name: 'COLOR_ID',
          field: 'COLOR_ID',
          label: 'COLOR_ID',
          align: 'left',
          sortable: true
        },
        {
          name: 'COLOR_DESC',
          field: 'COLOR_DESC',
          label: 'COLOR_DESC',
          align: 'left',
          sortable: true
        },
        {
          name: 'APPOINT_DATE',
          field: 'APPOINT_DATE',
          label: 'APPOINT_DATE',
          align: 'left',
          sortable: true
        },
        {
          name: 'ROLL',
          field: 'ROLL',
          label: 'ROLL',
          align: 'left',
          sortable: true
        },
        {
          name: 'WEIGHT',
          field: 'WEIGHT',
          label: 'WEIGHT',
          align: 'left',
          sortable: true
        },
        {
          name: 'DOZ',
          field: 'DOZ',
          label: 'DOZ',
          align: 'left',
          sortable: true
        },
        {
          name: 'YARD',
          field: 'YARD',
          label: 'YARD',
          align: 'left',
          sortable: true
        },
        {
          name: 'MPS_WEEK',
          field: 'MPS_WEEK',
          label: 'MPS_WEEK',
          align: 'left',
          sortable: true
        },
        {
          name: 'FG_WEEK',
          field: 'FG_WEEK',
          label: 'FG_WEEK',
          align: 'left',
          sortable: true
        },
        {
          name: 'FABRIC_TYPE',
          field: 'FABRIC_TYPE',
          label: 'FABRIC_TYPE',
          align: 'left',
          sortable: true
        },
        {
          name: 'BUYER',
          field: 'BUYER',
          label: 'BUYER',
          align: 'left',
          sortable: true
        },
        {
          name: 'OU_CODE',
          field: 'OU_CODE',
          label: 'OU_CODE',
          align: 'left',
          sortable: true
        },
        {
          name: 'TEAM_NAME',
          field: 'TEAM_NAME',
          label: 'TEAM_NAME',
          align: 'left',
          sortable: true
        },
        {
          name: 'REC_WW',
          field: 'REC_WW',
          label: 'REC_WW',
          align: 'left',
          sortable: true
        },
        {
          name: 'WIDTH',
          field: 'WIDTH',
          label: 'WIDTH',
          align: 'left',
          sortable: true
        },
        {
          name: 'WEIGHT_G',
          field: 'WEIGHT_G',
          label: 'WEIGHT_G',
          align: 'left',
          sortable: true
        },
        {
          name: 'FG_TYPE',
          field: 'FG_TYPE',
          label: 'FG_TYPE',
          align: 'left',
          sortable: true
        },
        {
          name: 'GRADE',
          field: 'GRADE',
          label: 'GRADE',
          align: 'left',
          sortable: true
        },
        {
          name: 'AGEING_DAY',
          field: 'AGEING_DAY',
          label: 'AGEING_DAY',
          align: 'left',
          sortable: true
        },
        {
          name: 'PL_COLORLAB',
          field: 'PL_COLORLAB',
          label: 'PL_COLORLAB',
          align: 'left',
          sortable: true
        },
        {
          name: 'SCHEDULE_ID',
          field: 'SCHEDULE_ID',
          label: 'SCHEDULE_ID',
          align: 'left',
          sortable: true
        }
      ]
    }
  },
  mounted() {
    this.Init()
  },
  methods: {
    async Init() {
      let params = new FormData()

      await this.axios({
        method: "post",
        url: this.$api + "init.php/year_init",
        data: params
      }).then(res => {
        this.dteS = res.data.dts
        this.dteE = res.data.dte

      });
    },
    async QueryData() {
      let params = new FormData()
      params.append("so", this.sono)
      params.append("dteS", this.dteS)
      params.append("dteE", this.dteE)

      await this.axios({
        method: "post",
        url: this.$api + "fg.php",
        data: params
      }).then(res => {
        // console.log(res.data)
        this.datas = res.data.rows

      });
    },
    async onExport() {
      let params = new FormData();
      params.append("so", this.sono)
      params.append("dteS", this.dteS)
      params.append("dteE", this.dteE)

      await this.axios({
        method: "post",
        url: this.$api + "fgthaiexport.php",
        data: params
      }).then(res => {
        //console.log(res.data)
        this.excel = res.data
        const dataWS = XLSX.utils.json_to_sheet(this.excel)
        const wb = XLSX.utils.book_new()
        XLSX.utils.book_append_sheet(wb, dataWS)
        XLSX.writeFile(wb, 'export_fg.xlsx')
      });
    }
  }
}
</script>
