<template>
  <div class="q-pa-md">
    <q-table
      dense
      :data="data"
      :columns="columns"
      row-key="KEYS"
      :filter="filter"
      :pagination.sync="pagination"
      :table-header-style="{ backgroundColor: '#027be3' }"
    >
      <template v-slot:top-right>
        <q-input dense debounce="300" v-model="filter" placeholder="Search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </template>

      <template v-slot:body-cell-QT="props">
        <q-td :props="props">
          <q-icon
            name="print"
            class="text-teal"
            style="font-size: 2em; cursor: pointer"
            @click="OpenPage(props)"
          />
        </q-td>
      </template>

      <template v-slot:body-cell-INS="props">
        <!-- <a :href="'/naylit/#/QTReport/'+props+'/'+props.BATCH_NO" target="qtreport"></a> -->
        <q-td :props="props">
          <q-icon
            name="print"
            class="text-teal"
            style="font-size: 2em; cursor: pointer"
            @click="OpenPageIns(props)"
          />
        </q-td>
      </template>

      <!-- <template v-slot:body-cell-KEYS="props">
      <q-td :props="props">
        <span class="text-primary" style="cursor:pointer;text-decoration:underline;" @click="OpenPage(props)">{{props.value}}
        </span>
      </q-td>
    </template> -->
    </q-table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      filter: "",
      pagination: {
        sortBy: "desc",
        descending: false,
        page: 1,
        rowsPerPage: 10,
      },
      columns: [
        {
          name: "QT",
          field: "QT",
          label: "QT",
          align: "left",
          sortable: true,
        },
        {
          name: "INS",
          field: "INS",
          label: "INS.",
          align: "left",
          sortable: true,
        },

        {
          name: "KEYS",
          field: "KEYS",
          label: "Batch No.",
          align: "left",
          sortable: true,
        },
        {
          name: "SO_NO",
          field: "SO_NO",
          label: "SO No.",
          align: "left",
          sortable: true,
        },
        {
          name: "SCHEDULE_ID",
          field: "SCHEDULE_ID",
          label: "Schedule ID",
          align: "left",
          sortable: true,
        },
        {
          name: "BATCH_ENTRY_DATE",
          field: "BATCH_ENTRY_DATE",
          label: "Batch Date",
          align: "left",
          sortable: true,
        },
        {
          name: "TOTAL_ROLL",
          field: "TOTAL_ROLL",
          label: "RM Roll(s)",
          align: "right",
          sortable: true,
        },
        {
          name: "TOTAL_QTY",
          field: "TOTAL_QTY",
          label: "RM Quantity",
          align: "right",
          sortable: true,
        },
        {
          name: "STATUS_BATCH",
          field: "STATUS_BATCH",
          label: "Status",
          align: "left",
          sortable: true,
        },
        {
          name: "ROLL_PASS",
          field: "ROLL_PASS",
          label: "Pass Roll(s)",
          align: "right",
          sortable: true,
        },
        {
          name: "QTY_PASS",
          field: "QTY_PASS",
          label: "Pass Quantity",
          align: "right",
          sortable: true,
        },
        {
          name: "REJECT_ROLL",
          field: "REJECT_ROLL",
          label: "Reject Roll(s)",
          align: "right",
          sortable: true,
        },
        {
          name: "REJECT_QTY",
          field: "REJECT_QTY",
          label: "Reject Quantity",
          align: "right",
          sortable: true,
        },
      ],
      data: [],
    };
  },
  mounted() {
    this.QueryData();
  },
  methods: {
    async QueryData1() {
      let params = new FormData();
      // params.append("so", this.sono)
      // params.append("dteS", this.dteS)
      // params.append("dteE", this.dteE)

      await axios({
        method: "post",
        url: this.$api + "qt2.php/qtlist",
        data: params,
      }).then((res) => {
        // console.log('1111111111111')
        console.log(res.data);
        this.data = res.data;
      });
    },

    async QueryData() {
      const postjson = { };
      await axios({
        method: "post",
        url: this.$api + "qt.php/qtlist",
        data: postjson,
      }).then((res) => {
        console.log('/naylit/api by flask')
        // console.log(res.data);
        this.data = res.data;
      });
    },

    OpenPage(obj) {
      // console.log(obj.row.OU_CODE)
      // console.log(obj.row.BATCH_NO)
      window.open(
        "/naylit/#/QTReport/" + obj.row.OU_CODE + "/" + obj.row.BATCH_NO,
        obj.row.OU_CODE + obj.row.BATCH_NO
      );
    },
    OpenPageIns(obj) {
      window.open(
        "/naylit/#/Inspec/" + obj.row.OU_CODE + "/" + obj.row.BATCH_NO,
        obj.row.OU_CODE + obj.row.BATCH_NO
      );
    },
  },
};
</script>

<style>
</style>
