<template>
<div class="q-pa-md">

  <div class="row q-col-gutter-xs q-gutter-y-lg">
    <div class="col-md-12">

      <q-table class="my-sticky-column-table" dense title="" :data="data" :columns="columns" row-key="KEY" :pagination.sync="pagination" :loading="loading" :filter="filter" binary-state-sort table-header-class="bg-primary text-white">
        <template v-slot:top-left>
          <q-select dense v-model="year" :options="[2020,2019]" label="PO Recived Year" stack-label style="width:150px;" @input="QueryData" />

        </template>
        <template v-slot:top-right>
          <q-input dense debounce="300" v-model="filter" label="Search" stack-label>
            <template v-slot:append>
              <q-icon style="cursor:pointer;" name="search" @click="QueryData" />
            </template>
          </q-input>
          <q-btn round size="sm" class="text-capitalize glossy" color="primary" label="Excel" @click="onExport">
            <q-tooltip content-class="bg-blue-4" :offset="[10, 10]">
              Export Excel
            </q-tooltip>
          </q-btn>
        </template>
        <!-- <template v-slot:body="props">
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
        </template> -->
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
        // rowsNumber: 2
      },
      year: 2020,
      columns: [
        //  {
        //   name: 'KEY',
        //   field: 'KEY',
        //   align: 'left',
        //   label: 'KEY',
        //   sortable: false
        // },
        {
          name: 'SOURCEING_OFFICE',
          field: 'SOURCEING_OFFICE',
          align: 'left',
          label: 'Sourcing Office Name',
          sortable: true
        },
        {
          name: 'FACTORY_CUSTOMER_NAME',
          field: 'FACTORY_CUSTOMER_NAME',
          align: 'left',
          label: 'Factory Customer Name',
          sortable: true
        },
        {
          name: 'FABRIC_DESC',
          field: 'FABRIC_DESC',
          align: 'left',
          label: 'Fabric Disc',
          sortable: true
        },
        {
          name: 'PO_NO',
          field: 'PO_NO',
          align: 'left',
          label: 'PO',
          sortable: true
        },

        {
          name: 'SAMPLE_TYPE',
          field: 'SAMPLE_TYPE',
          align: 'left',
          label: 'Sample Type',
          sortable: true
        },

        {
          name: 'PO_RECIVED_DATE',
          field: 'PO_RECIVED_DATE',
          align: 'left',
          label: 'PO Recived Date',
          sortable: true
        },
        {
          name: 'PLAN_SHIPDATE',
          field: 'PLAN_SHIPDATE',
          align: 'left',
          label: 'Ship/SchDate (Plan Ship)',
          sortable: true
        },
        {
          name: 'FACTORY_SHIPDATE',
          field: 'FACTORY_SHIPDATE',
          align: 'left',
          label: 'EX-Fac. Actual Ship',
          sortable: true
        },

        {
          name: 'IM_CORD',
          field: 'IM_CORD',
          align: 'left',
          label: 'IM# Cord',
          sortable: true
        },
        {
          name: 'ITEM_NAYLIT',
          field: 'ITEM_NAYLIT',
          align: 'left',
          label: 'Item Naylit',
          sortable: true
        },
        {
          name: 'COLOR_PO_DESC',
          field: 'COLOR_PO_DESC',
          align: 'left',
          label: 'Color',
          sortable: true
        },

        {
          name: 'COLOR_CODE',
          field: 'COLOR_CODE',
          align: 'left',
          label: 'Color Code',
          sortable: true
        },
        {
          name: 'ORDER_QTY',
          field: 'ORDER_QTY',
          align: 'left',
          label: 'Shp/Sch Qty Yard',
          sortable: true
        },

        {
          name: 'SHIP_QTY',
          field: 'SHIP_QTY',
          align: 'left',
          label: 'Actual Shipped Qty Yard',
          sortable: true
        },
        {
          name: 'FOC_QTY',
          field: 'FOC_QTY',
          align: 'left',
          label: 'FOC Qty Yard',
          sortable: true
        },
        {
          name: 'PI_NO',
          field: 'PI_NO',
          align: 'left',
          label: 'PI No',
          sortable: true
        }, {
          name: 'SO_NO',
          field: 'SO_NO',
          align: 'left',
          label: 'So No.',
          sortable: true
        }, {
          name: 'INV_NO',
          field: 'INV_NO',
          align: 'left',
          label: 'Invoice No.',
          sortable: true
        },
        {
          name: 'LINE_REMARK',
          field: 'LINE_REMARK',
          align: 'left',
          label: 'Remark',
          sortable: true
        }

        // {
        //   name: 'PO_UOM',
        //   field: 'PO_UOM',
        //   align: 'left',
        //   label: 'PO_UOM',
        //   sortable: true
        // },
        // {
        //   name: 'PO_STATUS',
        //   field: 'PO_STATUS',
        //   align: 'left',
        //   label: 'PO_STATUS',
        //   sortable: true
        // },
        // {
        //   name: 'UPD_DATE',
        //   field: 'UPD_DATE',
        //   align: 'left',
        //   label: 'UPD_DATE',
        //   sortable: true
        // },
        // {
        //   name: 'UPD_BY',
        //   field: 'UPD_BY',
        //   align: 'left',
        //   label: 'UPD_BY',
        //   sortable: true
        // },
        // {
        //   name: 'PO_LINE',
        //   field: 'PO_LINE',
        //   align: 'left',
        //   label: 'PO_LINE',
        //   sortable: true
        // },

        // {
        //   name: 'LINE_STATUS',
        //   field: 'LINE_STATUS',
        //   align: 'left',
        //   label: 'LINE_STATUS',
        //   sortable: true
        // },

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

      this.onRequest()

    },
    async onExport() {
      console.log(this.filter)

      let params = new FormData();
      params.append("year", this.year);

      await axios({
        method: "post",
        url: this.$api + "pocus.php/export",
        data: params
      }).then(res => {
        //console.log(res.data)
        this.excel = res.data
        const dataWS = XLSX.utils.json_to_sheet(this.excel)
        const wb = XLSX.utils.book_new()
        XLSX.utils.book_append_sheet(wb, dataWS)
        XLSX.writeFile(wb, 'export_pocus.xlsx')
      });

    },
    async onRequest() {
      this.loading = true
      let params = new FormData()
      params.append("year", this.year);
      await axios({
        method: "post",
        url: this.$api + "pocus.php/listcuspo",
        data: params
      }).then(res => {
        this.data = res.data
        // console.log(res.data)
        this.loading = false
      });
    }
  }
}
</script>

<style>

</style>
