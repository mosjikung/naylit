<template>
<div class="q-pa-md">
  <div class="row q-col-gutter-xs ">
    <div class="col-md-1 col-sm-2 col-xs-3">
      
      <q-input v-model="sono" label="SO No." stack-label dense />

    </div>
    <div class="col-md-2 col-sm-2 col-xs-3">

      <q-field label="SO Date From" stack-label dense>
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

      <q-field label="SO Date To" stack-label dense>
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
      <q-btn round size="sm" icon="search" color="primary" class="glossy q-ma-xs" @click="QueryData">
        <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
          Search
        </q-tooltip>
      </q-btn>
      <q-btn size="sm" class="text-capitalize glossy q-ma-xs" color="primary" label="Excel SO" @click="onExport">
        <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
          Export Excel
        </q-tooltip>
      </q-btn>
      <q-btn size="sm" class="text-capitalize glossy q-ma-xs" color="primary" label="Excel Batch" @click="onExportBatch" v-show="($store.getters.role=='ADMIN')">
        <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
          Export Excel
        </q-tooltip>
      </q-btn>
    </div>
  </div>
  <div class="row q-col-gutter-xs q-gutter-y-lg">
    <div class="col-md-12">
      <q-table class="table-so-head" title="" dense :data="list_so" :columns="columns_so" row-key="SO_NO" separator="cell" :pagination.sync="pagination">

        <template v-slot:header="props">
          <q-tr :props="props">
            <q-th v-for="col in props.cols" :key="col.name" :props="props" class="bg-indigo-10 text-white">
              {{ col.label }}
            </q-th>
          </q-tr>
        </template>

        <!-- <q-td slot="body-cell-REMARK" slot-scope="props" :props="props" style="padding:0px 5px;">
                    <span class="ellipsis" style="display:block;max-width:245px;">
                        <q-btn dense round flat :icon="props.expand ? 'arrow_drop_up' : 'arrow_drop_down'" @click="props.expand = !props.expand" />
                        {{props.value}}
                        <q-tooltip content-class="bg-purple" content-style="font-size: 12px;" :offset="[10, 10]">
                            {{props.value}}
                        </q-tooltip>
                    </span>
                </q-td> -->

        <template v-slot:body="props">
          <q-tr :props="props">
            <q-td key="SO_NO" :props="props">
              {{ props.row.SO_NO }}
              <q-btn size="8px" round flat :icon="props.expand ? 'arrow_drop_up' : 'arrow_drop_down'" @click="props.expand = !props.expand" />
            </q-td>
            <q-td key="SO_NO_DATE" :props="props">{{ props.row.SO_NO_DATE }}</q-td>
            <q-td key="ORDERED_QUANTITY" class="text-bold" :props="props">{{ props.row.ORDERED_QUANTITY |numeral('0,0.00')}}</q-td>
            <q-td key="CUSTOMER_YEAR" :props="props">{{ props.row.CUSTOMER_YEAR }}-{{ props.row.CUSTOMER_FG }}</q-td>
            <q-td key="NYF_BUYER" :props="props">{{ props.row.NYF_BUYER }}</q-td>
            <q-td key="SO_PROD_CLOSED" :props="props">
              {{ props.row.SO_PROD_CLOSED }}
            </q-td>
            <q-td key="PO_NO" :props="props">{{ props.row.PO_NO }}</q-td>
            <q-td key="REMARK" :props="props">

              <span class="ellipsis" style="display:block;max-width:245px;">

                {{ props.row.REMARK }}
                <q-tooltip content-class="bg-purple" content-style="font-size: 12px;" :offset="[10, 10]">
                  {{ props.row.REMARK }}
                </q-tooltip>
              </span>

            </q-td>

          </q-tr>
          <q-tr v-show="props.expand" :props="props">
            <q-td colspan="100%" style="padding:0px;">

              <div class="row q-col-gutter-sm">
                <div class="col-md-12 col-xs-12 q-gutter-sm">
                  <SODetail :sono="props.row.SO_NO" v-if="props.expand"></SODetail>
                </div>
              </div>

            </q-td>
          </q-tr>
        </template>

      </q-table>
    </div>
  </div>

</div>
</template>

<script>
import axios from 'axios'
import SODetail from './SODetail'
import XLSX from 'xlsx'

export default {
  components: {
    SODetail
  },
  data() {
    return {
      sono: '',
      dteS: '',
      dteE: '',
      pagination: {
        sortBy: 'SO_NO',
        descending: false,
        page: 1,
        rowsPerPage: 10
      },
      list_so: [],
      columns_so: [{
          name: 'SO_NO',
          field: 'SO_NO',
          label: 'SO No.',
          align: 'left',
          sortable: true,
          required: true,
          style: 'max-width: 80px',
          headerStyle: 'width: 80px'
        },
        {
          name: 'SO_NO_DATE',
          field: 'SO_NO_DATE',
          label: 'SO Date',
          align: 'center',
          sortable: true,
          style: 'max-width: 70px',
          headerStyle: 'width: 70px'
        },
        {
          name: 'ORDERED_QUANTITY',
          field: 'ORDERED_QUANTITY',
          label: 'Quantity',
          align: 'right',
          sortable: true
        },
        {
          name: 'CUSTOMER_YEAR',
          field: 'CUSTOMER_YEAR',
          label: 'FG Week',
          align: 'center',
          sortable: true,
          style: 'max-width: 70px',
          headerStyle: 'width: 70px'
        },
        {
          name: 'NYF_BUYER',
          field: 'NYF_BUYER',
          label: 'Buyer',
          align: 'left',
          sortable: true
        },
        {
          name: 'SO_PROD_CLOSED',
          field: 'SO_PROD_CLOSED',
          label: 'Closed Date',
          align: 'center',
          sortable: true,
          style: 'max-width: 70px',
          headerStyle: 'max-width: 70px;'
        },
        {
          name: 'PO_NO',
          field: 'PO_NO',
          label: 'PO No.',
          align: 'left',
          sortable: true
        },
        {
          name: 'REMARK',
          field: 'REMARK',
          label: 'Remark',
          align: 'left',
          sortable: true,

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

      await axios({
        method: "post",
        url: this.$api + "wip.php/listso",
        data: params
      }).then(res => {

        this.list_so = res.data

      });
    },
    async onExport() {
      //console.log(this.filter)

      let params = new FormData();
      params.append("role", this.$store.getters.role)
      params.append("so", this.sono)
      params.append("dteS", this.dteS)
      params.append("dteE", this.dteE)

      await axios({
        method: "post",
        url: this.$api + "wip.php/wip_export",
        data: params
      }).then(res => {
        //console.log(res.data)
        this.excel = res.data
        const dataWS = XLSX.utils.json_to_sheet(this.excel)
        const wb = XLSX.utils.book_new()
        XLSX.utils.book_append_sheet(wb, dataWS)
        XLSX.writeFile(wb, 'wip_export.xlsx')
      });

    },
    async onExportBatch() {
      console.log(this.dteS)
      console.log(this.dteE)

      let params = new FormData();
      params.append("role", this.$store.getters.role)
      params.append("so", this.sono)
      params.append("S", this.dteS)
      params.append("E", this.dteE)

      let q = "?so="+this.sono+"&S="+this.dteS+"&E="+this.dteE
      window.open('http://peoplefinder.nanyangtextile.com/service/NAYLIT/ExportBatch.ashx'+q)
      // window.open('http://localhost:64380/NAYLIT/ExportBatch.ashx'+q)
      // await axios({
      //   method: "post",
      //   url: this.$api + "http://peoplefinder.nanyangtextile.com/service/NAYLIT/ExportBatch.ashx",
      //   data: params
      // }).then(res => {
      //   console.log(res.data)
      //   this.excel = res.data
      //   const dataWS = XLSX.utils.json_to_sheet(this.excel)
      //   const wb = XLSX.utils.book_new()
      //   XLSX.utils.book_append_sheet(wb, dataWS)
      //   XLSX.writeFile(wb, 'wip_export.xlsx')
      // });

    }
  }
}
</script>

<style scoped>
.table-so-head>>>td:first-child {
  width: 145px;
}

.table-so-head>>>td:nth-child(2) {
  width: 120px;
}

/* .table-so-head>>>td:nth-child(3) {
    width: 100px;
} */

.table-so-head>>>td:nth-child(4) {
  width: 120px;
}
</style>
