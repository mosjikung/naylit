<template>
<div>
  <q-table class="table-so-detail" title="" dense :data="soline" :columns="columns_line" row-key="LINE_ID" hide-bottom separator="cell" :pagination.sync="pagination">

    <template v-slot:header="props">
      <q-tr :props="props">
        <q-th v-for="col in props.cols" :key="col.name" :props="props" class="bg-indigo-4 text-white">
          {{ col.label }}
        </q-th>
      </q-tr>
    </template>

    <template v-slot:body="props">
      <q-tr :props="props">
        <q-td key="LINE_ID" :props="props">
          {{ props.row.LINE_ID }}
          <q-btn size="8px" round flat :icon="props.expand ? 'arrow_drop_up' : 'arrow_drop_down'" @click="props.expand = !props.expand" />
        </q-td>
        <q-td key="CANCLED_QUANTITY" :props="props">{{ props.row.CANCLED_QUANTITY |numeral('0,0.00')}}</q-td>
        <q-td key="ORDERED_QUANTITY" :props="props"><span class="text-bold">{{ props.row.ORDERED_QUANTITY |numeral('0,0.00')}}</span></q-td>
        <q-td key="SCHEDULE_QUANTITY" :props="props"><span class="text-bold">{{ props.row.SCHEDULE_QUANTITY |numeral('0,0.00')}}</span></q-td>

        <q-td key="UOM" :props="props">{{ props.row.UOM }}</q-td>
        <q-td key="ITEM_CODE" :props="props">{{ props.row.ITEM_CODE }}</q-td>
        <q-td key="COLOR_CODE" :props="props">{{ props.row.COLOR_CODE }}</q-td>
        <q-td key="PL_COLORLAB" :props="props">{{ props.row.PL_COLORLAB }}</q-td>
        <q-td key="ITEM_DESC" :props="props">{{ props.row.ITEM_DESC }}</q-td>

      </q-tr>
      <q-tr v-show="props.expand" :props="props">
        <q-td colspan="100%" style="padding:0px;">
          <div class="row q-col-gutter-sm">
            <div class="col-md-12 col-xs-12 q-gutter-sm">
              <scheduled :sono="props.row.SO_NO" :line="props.row.LINE_ID" v-if="props.expand"></scheduled>
            </div>
          </div>
        </q-td>
      </q-tr>

    </template>

    <!-- <q-td slot="body-cell-ORDERED_QUANTITY" slot-scope="props" :props="props">
            {{props.value|numeral('0,0.00')}}
        </q-td>
        <q-td slot="body-cell-CANCLED_QUANTITY" slot-scope="props" :props="props">
            {{props.value|numeral('0,0.00')}}
        </q-td> -->

    <template v-slot:bottom-row>
      <q-tr>
        <q-td class="text-right text-bold">
          Total
        </q-td>
        <q-td class="text-right text-bold">
          {{getCancel|numeral('0,0.00')}}
        </q-td>
        <q-td class="text-right text-bold">
          {{getSum|numeral('0,0.00')}}
        </q-td>

        <q-td colspan="5">

        </q-td>
      </q-tr>
    </template>

  </q-table>
</div>
</template>

<script>
import axios from "axios";
import scheduled from './scheduled'

export default {
  components: {
    scheduled
  },
  props: {
    sono: String,
    devcode: String,
    render: false,
    sumqty: 0,
    sumcancel: 0
  },
  data() {
    return {
      soline: [],
      pagination: {
        sortBy: 'LINE_ID',
        descending: false,
        page: 1,
        rowsPerPage: -1
      },
      columns_line: [{
          name: 'LINE_ID',
          field: 'LINE_ID',
          label: 'Line',
          align: 'left',
          sortable: true,
          required: true
        },
        {
          name: 'CANCLED_QUANTITY',
          field: 'CANCLED_QUANTITY',
          label: 'Cancel Qty.',
          align: 'right',
          sortable: true
        },
        {
          name: 'ORDERED_QUANTITY',
          field: 'ORDERED_QUANTITY',
          label: 'Quantity',
          align: 'right',
          sortable: true
        },
        {
          name: 'SCHEDULE_QUANTITY',
          field: 'SCHEDULE_QUANTITY',
          label: 'Sch. Quantity',
          align: 'right',
          sortable: true
        },
        {
          name: 'UOM',
          field: 'UOM',
          label: 'Unit',
          align: 'left',
          sortable: true
        },
        {
          name: 'ITEM_CODE',
          field: 'ITEM_CODE',
          label: 'Item',
          align: 'left',
          sortable: true
        },
        {
          name: 'COLOR_CODE',
          field: 'COLOR_CODE',
          label: 'Color Code',
          align: 'left',
          sortable: true
        },
        {
          name: 'PL_COLORLAB',
          field: 'PL_COLORLAB',
          label: 'Color Lab.',
          align: 'left',
          sortable: true
        },
        {
          name: 'ITEM_DESC',
          field: 'ITEM_DESC',
          label: 'Item Desc.',
          align: 'left',
          sortable: true
        }

      ]
    }
  },
  mounted() {
    this.QueryData();
  },
  methods: {
    async QueryData() {
      let params = new FormData()
      params.append("so", this.sono)

      await axios({
        method: "post",
        url: this.$api + "wip.php/sodetail",
        data: params
      }).then(res => {
        //console.log(res.data)
        this.soline = res.data

      });
    }
  },
  computed: {
    getSum() {

      let self = this
      var _sum = 0;
      for (let i = 0; i < this.soline.length; i++) {
        _sum += parseFloat(self.soline[i]['ORDERED_QUANTITY']);
      }
      return _sum;
    },
    getCancel() {

      let self = this
      var _sum = 0;
      for (let i = 0; i < this.soline.length; i++) {
        _sum += parseFloat(self.soline[i]['CANCLED_QUANTITY']);
      }
      return _sum;
    }

  }
}
</script>

<style scoped>
.table-so-detail>>>td:first-child {
  width: 145px;
}

.table-so-detail>>>td:nth-child(2) {
  width: 100px;
}

.table-so-detail>>>td:nth-child(3) {
  width: 100px;
}

.table-so-detail>>>td:nth-child(4) {
  width: 100px;
}

.table-so-detail>>>td:nth-child(5) {
  width: 100px;
}

.table-so-detail>>>td:nth-child(6) {
  width: 150px;
}

.table-so-detail>>>td:nth-child(7) {
  width: 150px;
}

.table-so-detail>>>td:nth-child(8) {
  width: 150px;
}
</style>
