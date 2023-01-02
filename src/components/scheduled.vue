<template>
<div>
  <q-table class="table-schedule" style="max-width:98%" title="" :data="datas" :columns="columns" row-key="SCHEDULE_ID" separator="none" hide-bottom :pagination.sync="pagination" :visible-columns="visibleColumns">

    <template v-slot:header="props">
      <q-tr :props="props">
        <q-th v-for="col in props.cols" :key="col.name" :props="props" class="bg-indigo-2 text-brown">
          {{ col.label }}
        </q-th>
      </q-tr>
    </template>

    <template v-slot:body="props">
      <q-tr :props="props">
        <q-td key="SCHEDULE_ID" :props="props">
          <span style="text-decoration:underline;cursor:pointer;" class="text-primary" @click="ShowBatch(props.row.Batch)">
            {{ props.row.SCHEDULE_ID }} ({{props.row.BATCH_CNT}})
          </span>
          <!-- <q-btn size="8px" round flat :icon="props.expand ? 'arrow_drop_down' : 'arrow_drop_up'" @click="props.expand = !props.expand" /> -->
        </q-td>
        <q-td key="MACHINE_NO" :props="props">{{ props.row.MACHINE_NO }} ({{ props.row.MC_SIZE }})</q-td>
        <q-td key="FABRIC_QUANTITY" :props="props">{{ props.row.FABRIC_QUANTITY |numeral('0,0') }}</q-td>
        <q-td key="NYK_REC_WEIGHT" :props="props">{{ props.row.NYK_REC_WEIGHT }}</q-td>
        <q-td key="FG_KG" :props="props">{{ props.row.FG_KG |numeral('0,0.00') }}</q-td>
        <q-td key="FG_YARD" :props="props">{{ props.row.FG_YARD |numeral('0,0.00') }}</q-td>
        <q-td key="LOSS_KG" :props="props">{{ props.row.LOSS_KG |numeral('0,0.00') }}</q-td>
        <q-td key="LOSS_P" :props="props">{{ props.row.LOSS_P |numeral('0,0.00') }}</q-td>
        <q-td key="PO_RM" :props="props">{{ props.row.PO_RM }}</q-td>
        <q-td key="TEAM_WORK_YEAR" :props="props">{{ props.row.TEAM_WORK_YEAR }}-{{ props.row.TEAM_WORK_WEEK }}</q-td>
        <q-td key="GREY_ACTIVE" :props="props">{{ props.row.GREY_ACTIVE }}</q-td>
        <q-td key="FABRIC_RECEIVE" :props="props">{{ props.row.FABRIC_RECEIVE }}</q-td>
        <q-td key="NYK_REC_DATE" :props="props">{{ props.row.NYK_REC_DATE }}</q-td>
        <q-td key="NYK_FG_NO" :props="props">{{ props.row.NYK_FG_NO }}</q-td>

        <q-td key="DYE_END_DATE" :props="props">{{ props.row.DYE_END_DATE }}</q-td>
        <q-td key="NYK_FG_DATE" :props="props">{{ props.row.NYK_FG_DATE }}</q-td>
        <q-td key="NYK_FG_WEIGHT" :props="props">{{ props.row.NYK_FG_WEIGHT }}</q-td>
        <q-td key="NYK_SHPCUST_DATE" :props="props">{{ props.row.NYK_SHPCUST_DATE }}</q-td>
        <q-td key="NYK_SHP_CUST" :props="props">{{ props.row.NYK_SHP_CUST }}</q-td>

      </q-tr>
      <!-- <q-tr v-show="!props.expand" :props="props">

            </q-tr> -->

    </template>

    <!-- <q-td slot="body-cell-ORDERED_QUANTITY" slot-scope="props" :props="props">
            {{props.value|numeral('0,0.00')}}
        </q-td>
        <q-td slot="body-cell-CANCLED_QUANTITY" slot-scope="props" :props="props">
            {{props.value|numeral('0,0.00')}}
        </q-td> -->

    <template v-slot:bottom-row>
      <q-tr>
        <q-td>

        </q-td>
        <q-td class="text-right text-bold">
          Total
        </q-td>
        <q-td class="text-right text-bold">
          {{getSum|numeral('0,0')}}
        </q-td>
        <q-td class="text-right text-bold">
          {{getSum2|numeral('0,0.00')}}
        </q-td>
        <q-td class="text-right text-bold">
          {{getSum3|numeral('0,0.00')}}
        </q-td>
        <q-td class="text-right text-bold">
          {{getSum4|numeral('0,0.00')}}
        </q-td>
        <q-td class="text-right text-bold" v-if="$store.getters.role=='ADMIN'">
          {{getSum5|numeral('0,0.00')}}
        </q-td>
        <q-td class="text-right text-bold" v-if="$store.getters.role=='ADMIN'">
          {{getSum6|numeral('0,0.00')}}
        </q-td>
        <q-td colspan="11">

        </q-td>
      </q-tr>
    </template>

  </q-table>

  <q-dialog v-model="dialogBatch" persistent transition-show="scale" transition-hide="scale">
    <q-card style="width: 90vw; max-width: 90vw;">
      <q-card-section class="row items-center">
        <div class="text-h6">Batch</div>
        <q-space />
        <q-btn icon="close" flat round dense v-close-popup />
      </q-card-section>

      <q-card-section>

        <q-markup-table dense flat bordered class="table-batch">
          <thead class="bg-indigo-4 text-white">
            <tr>
              <th rowspan="2" class="text-left">Batch No.</th>
              <th rowspan="2" class="text-center">Batch Entry Date</th>
              <th colspan="2" class="text-center">Total</th>
              <th colspan="2" class="text-center">Pass</th>
              <th colspan="2" class="text-center">Reject</th>
              <th rowspan="2" class="text-center">Status Code</th>
              <th rowspan="2" class="text-left">Status Batch</th>
              <th rowspan="2" class="text-left">Process Desc.</th>
            </tr>
            <tr>
              <th class="text-right">Roll</th>
              <th class="text-right">Quantity</th>
              <th class="text-right">Pass Roll</th>
              <th class="text-right">Pass Quantity</th>
              <th class="text-right">Reject Roll</th>
              <th class="text-right">Reject Quantity</th>
            </tr>
          </thead>
          <tbody class="bg-grey-3">
            <tr v-for="b in batchs" v-bind:key="b.BATCH_NO">
              <td class="text-left">{{b.BATCH_NO}}</td>
              <td class="text-center">{{b.BATCH_ENTRY_DATE}}</td>
              <td class="text-right">{{b.TOTAL_ROLL}}</td>
              <td class="text-right">{{b.TOTAL_QTY}}</td>
              <td class="text-right">{{b.ROLL_PASS}}</td>
              <td class="text-right">{{b.QTY_PASS}}</td>
              <td class="text-right">{{b.REJECT_ROLL}}</td>
              <td class="text-right">{{b.REJECT_QTY}}</td>
              <td class="text-center">{{b.STATUS}}</td>
              <td class="text-left">{{b.STATUS_BATCH}}</td>
              <td class="text-left">{{b.STEP_BATCH}}</td>
            </tr>
          </tbody>
        </q-markup-table>

      </q-card-section>
    </q-card>
  </q-dialog>

</div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    sono: String,
    line: String
  },
  data() {
    return {
      visibleColumns: [],
      dialogBatch: false,
      batchs: [],
      datas: [],
      pagination: {
        sortBy: 'LINE_ID',
        descending: false,
        page: 1,
        rowsPerPage: -1
      },
      columns: [{
          name: 'SCHEDULE_ID',
          field: 'SCHEDULE_ID',
          label: 'Sch. ID (Batch)',
          align: 'left',
          sortable: true,
          required: true,
          // style: 'max-width: 60px',
          // headerStyle: 'width: 60px'
        },
        {
          name: 'MACHINE_NO',
          field: 'MACHINE_NO',
          label: 'M/C No. (Size)',
          align: 'left',
          sortable: true
        },
        {
          name: 'FABRIC_QUANTITY',
          field: 'FABRIC_QUANTITY',
          label: 'Plan KGs.',
          align: 'right',
          sortable: true
        },
        {
          name: 'NYK_REC_WEIGHT',
          field: 'NYK_REC_WEIGHT',
          label: 'RM KGs.',
          align: 'right',
          sortable: true
        },
        {
          name: 'FG_KG',
          field: 'FG_KG',
          label: 'FG KGs.',
          align: 'right',
          sortable: true
        },
        {
          name: 'FG_YARD',
          field: 'FG_YARD',
          label: 'FG Yard',
          align: 'right',
          sortable: true
        },
        {
          name: 'LOSS_KG',
          field: 'LOSS_KG',
          label: 'Loss KGs.',
          align: 'right',
          sortable: true
        },
        {
          name: 'LOSS_P',
          field: 'LOSS_P',
          label: 'Loss %',
          align: 'right',
          sortable: true
        },
         {
          name: 'PO_RM',
          field: 'PO_RM',
          label: 'PO RM',
          align: 'left',
          sortable: true
        },
        {
          name: 'TEAM_WORK_YEAR',
          field: 'TEAM_WORK_YEAR',
          label: 'Load Dye Wk.',
          align: 'center',
          sortable: true
        },
        {
          name: 'GREY_ACTIVE',
          field: 'GREY_ACTIVE',
          label: 'Grey',
          align: 'left',
          sortable: true
        },
        {
          name: 'FABRIC_RECEIVE',
          field: 'FABRIC_RECEIVE',
          label: 'RM Plan Rec.',
          align: 'center',
          sortable: true
        },
        {
          name: 'NYK_REC_DATE',
          field: 'NYK_REC_DATE',
          label: 'RM Act. Rec.',
          align: 'center',
          sortable: true
        },
        {
          name: 'NYK_FG_NO',
          field: 'NYK_FG_NO',
          label: 'Last Packing',
          align: 'left',
          sortable: true
        },

        {
          name: 'DYE_END_DATE',
          field: 'DYE_END_DATE',
          label: 'Finish Dye',
          align: 'center',
          sortable: true
        },
        {
          name: 'NYK_FG_DATE',
          field: 'NYK_FG_DATE',
          label: 'FG. Dte',
          align: 'center',
          sortable: true
        },
        {
          name: 'NYK_SHPCUST_DATE',
          field: 'NYK_SHPCUST_DATE',
          label: 'Ship Date',
          align: 'center',
          sortable: true
        },
        {
          name: 'NYK_SHP_CUST',
          field: 'NYK_SHP_CUST',
          label: 'Ship Weight',
          align: 'right',
          sortable: true
        }
      ]
    }
  },
  mounted() {
    if(this.$store.getters.role!='ADMIN')
    {
      this.visibleColumns= ['SCHEDULE_ID','MACHINE_NO','FABRIC_QUANTITY','NYK_REC_WEIGHT','FG_KG','FG_YARD','PO_RM','TEAM_WORK_YEAR','GREY_ACTIVE','FABRIC_RECEIVE','NYK_REC_DATE','NYK_FG_NO','DYE_END_DATE','NYK_FG_DATE','NYK_SHPCUST_DATE','NYK_SHP_CUST']
    }else{
this.visibleColumns= ['SCHEDULE_ID','MACHINE_NO','FABRIC_QUANTITY','NYK_REC_WEIGHT','FG_KG','FG_YARD','LOSS_KG','LOSS_P','PO_RM','TEAM_WORK_YEAR','GREY_ACTIVE','FABRIC_RECEIVE','NYK_REC_DATE','NYK_FG_NO','DYE_END_DATE','NYK_FG_DATE','NYK_SHPCUST_DATE','NYK_SHP_CUST']
    }
    this.QueryData();
  },
  methods: {
    async QueryData() {
      let params = new FormData()
      params.append("so", this.sono)
      params.append("line", this.line)

      await axios({
        method: "post",
        url: this.$api + "wip.php/schedule",
        data: params
      }).then(res => {
        console.log(res.data)
        this.datas = res.data

      });
    },
    ShowBatch(obj) {
      this.dialogBatch = true
      this.batchs = obj
      console.log(obj)
    }
  },
  computed: {
    getSum() {

      let self = this
      var _sum = 0;
      for (let i = 0; i < this.datas.length; i++) {
        _sum += parseFloat(self.datas[i]['FABRIC_QUANTITY']);
      }
      return _sum;
    },
    getSum2() {

      let self = this
      var _sum = 0;
      for (let i = 0; i < this.datas.length; i++) {
        _sum += parseFloat(self.datas[i]['NYK_REC_WEIGHT']);
      }
      return _sum;
    },
    getSum3() {

      let self = this
      var _sum = 0;
      for (let i = 0; i < this.datas.length; i++) {
        _sum += parseFloat(self.datas[i]['FG_KG']);
      }
      return _sum;
    },
    getSum4() {

      let self = this
      var _sum = 0;
      for (let i = 0; i < this.datas.length; i++) {
        _sum += parseFloat(self.datas[i]['FG_YARD']);
      }
      return _sum;
    },
    getSum5() {

      let self = this
      var _sum = 0;
      for (let i = 0; i < this.datas.length; i++) {
        _sum += parseFloat(self.datas[i]['LOSS_KG']);
      }
      return _sum;
    },
    getSum6() {

      var _sum = 0;
      if(this.getSum2!=0){
        _sum = (this.getSum2-this.getSum3)/this.getSum2
      }
      return _sum
    },
    // getCancel() {

    //     let self = this
    //     var _sum = 0;
    //     for (let i = 0; i < this.soline.length; i++) {
    //         _sum += parseFloat(self.soline[i]['CANCLED_QUANTITY']);
    //     }
    //     return _sum;
    // }

  }
}
</script>

<style scoped>
/* .table-schedule>>>div>>>table>>>td:first-child {
    width: 300px;
} */

/* .cccccccccccc {
    width: 300px;
} */

.table-batch th {
  border: 1px solid white;
}
</style>
