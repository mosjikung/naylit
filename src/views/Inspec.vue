<template>
<div>

  <template v-for="n in r.lines.length">

    <page size="A4" v-bind:key="n">
      <header>
        <table style="width:100%;border:1px solid grey;border-collapse: collapse;">
          <tr>
            <td colspan="6" class="text-center" style="border:1px solid grey;">
              <subject subject="Nan Yang Knitting Inspection Report"></subject>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid grey;">
              <subject subject="Customer"></subject>
              <txt :txt="r.CUSTOMER_NAME"></txt>
            </td>
            <td style="border:1px solid grey;">
              <subject subject="SO No."></subject>
              <txt :txt="r.SO_NO"></txt>/
              <subject subject="Line"></subject>
              <txt :txt="r.LINE_ID"></txt>
            </td>
            <td style="border:1px solid grey;">
              <subject subject="Batch No."></subject>
              <txt :txt="r.OU_BATCH"></txt>
            </td>
            <td style="border:1px solid grey;">
              <txt :txt="r.TOTAL_ROLL"></txt>
              <subject subject="Rolls"></subject>
              <!-- /<txt :txt="r.TOTAL_QTY"></txt><subject subject="KGs"></subject> -->
            </td>
            <td colspan="2" style="border:1px solid grey;">
              <subject subject="Inspector"></subject>
              <txt :txt="r.EMP_NAME"></txt>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid grey;">
              <subject subject="Item Code"></subject>
              <txt :txt="r.ITEM"></txt><br />
              <txt :txt="r.ITEM_DESC"></txt>
            </td>
            <td style="border:1px solid grey;">

              <subject subject="Color Code"></subject><br />
              <txt :txt="r.COLOR"></txt>
            </td>
            <td style="border:1px solid grey;">
              <subject subject="Standard Ins"></subject><br />
              <txt :txt="r.STD_YARD_POINT"></txt>
            </td>
            <td style="border:1px solid grey;">
              <subject subject="Width"></subject>/<subject subject="Weight"></subject><br />
              <txt :txt="r.C_WIDTH"></txt>
              <subject subject="''"></subject>/<txt :txt="r.WEIGHT_G"></txt>
              <subject subject="GM2"></subject>
            </td>
            <td style="border:1px solid grey;">
              <subject subject="MC"></subject>/<subject subject="Ins. No."></subject><br />
              <txt :txt="r.INS_MC"></txt>/<txt :txt="r.INS_NO"></txt>
            </td>
            <td style="border:1px solid grey;">
              <subject subject="Inspec Date"></subject><br />
              <txt :txt="r.INSPECTION_DATE"></txt>
            </td>
          </tr>
        </table>
      </header>
      <databody>
        <table style="width:100%;border:1px solid grey;border-collapse: collapse;">
          <tr>
            <td style="border:1px solid grey;width:100px;">
              <subject subject="Roll"></subject>
            </td>
            <td colspan="31" style="border:1px solid grey;">
              <subject subject="Defect/Point/Detail"></subject>
            </td>
            <td style="border:1px solid grey;width:25px;">
              <!-- <subject subject="No."></subject><br /> -->
              <subject subject="Total"></subject>
            </td>
            <!-- <td style="border:1px solid grey;width:25px;">
              <subject subject="No."></subject><br />
              <subject subject="of Point"></subject>
            </td> -->
            <td style="border:1px solid grey;width:65px;">
              <subject subject="Gross (yds)"></subject>
              <!-- <subject subject="yds"></subject> -->
            </td>
            <td style="border:1px solid grey;width:55px;">
              <subject subject="Net (yds)"></subject>
              <!-- <subject subject="yds"></subject> -->
            </td>
            <td style="border:1px solid grey;width:20px;">
              <subject subject="Grade"></subject>
            </td>
          </tr>

          <template v-for="d in r.lines[n-1]">

            <tr v-bind:key="d.ROLL_NO">
              <td style="border-top:1px solid grey;">
                <subject subject="Roll #"></subject>
                <txt :txt="d.ROLL_NO"></txt>

              </td>
              <td style="border:1px solid grey;width:80px;">
                <subject subject="Group Defect"></subject>
              </td>

              <td class="cell">
                <txt :txt="d.GR_CODE_01"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_02"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_03"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_04"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_05"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_06"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_07"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_08"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_09"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_10"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_11"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_12"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_13"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_14"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_15"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_16"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_17"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_18"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_19"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_20"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_21"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_22"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_23"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_24"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_25"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_26"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_27"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_28"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_29"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.GR_CODE_30"></txt>
              </td>
              <td style="border:1px solid grey;" class="text-center">
                <subject :subject="d.SUM_GR_CODE"></subject>
              </td>
              <!-- <td style="border:1px solid grey;">
                <subject subject=""></subject>
              </td> -->
              <td style="border:1px solid grey;" class="text-right">
                <subject :subject="d.LENGTH"></subject>
              </td>
              <td style="border:1px solid grey;" class="text-right">
                <subject :subject="d.TOTAL_LENGTH"></subject>
              </td>
              <td style="border:1px solid grey;">
                <subject :subject="d.GROSS_GRADE"></subject>
              </td>

            </tr>

            <tr>
              <td style="border:0px solid grey;">
                <subject subject="GM2"></subject>
                <txt :txt="d.GM2"></txt>

              </td>
              <td style="border:1px solid grey;">
                <subject subject="Location(th)"></subject>
              </td>

              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_01}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_02}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_03}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_04}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_05}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_06}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_07}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_08}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_09}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_10}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_11}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_12}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_13}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_14}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_15}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_16}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_17}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_18}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_19}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_20}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_21}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_22}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_23}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_24}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_25}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_26}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_27}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_28}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_29}}
              </td>
              <td class="cell" style="font-size:8px;width:18px;">
                {{d.START_POSITION_30}}
              </td>
              <td style="border:1px solid grey;">
                <subject subject=""></subject>
              </td>
              <!-- <td style="border:1px solid grey;">
                <subject subject=""></subject>
              </td> -->
              <td style="border:1px solid grey;" class="text-right">
                <!-- <subject :subject="d.LENGTH"></subject> -->
              </td>
              <td style="border:1px solid grey;" class="text-right">
                <!-- <subject :subject="d.TOTAL_LENGTH"></subject> -->
              </td>
              <td style="border:1px solid grey;" class="text-center">
                <!-- <subject :subject="d.GROSS_GRADE"></subject> -->
              </td>

            </tr>

            <tr>
              <td style="border:0px solid grey;">
                <subject subject="C.Width"></subject>
                <txt :txt="d.C_WIDTH"></txt>

              </td>
              <td style="border:1px solid grey;">
                <subject subject="Defect Type"></subject>
              </td>

              <td class="cell">
                <txt :txt="d.DEF_ID_01"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_02"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_03"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_04"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_05"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_06"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_07"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_08"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_09"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_10"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_11"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_12"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_13"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_14"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_15"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_16"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_17"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_18"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_19"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_20"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_21"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_22"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_23"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_24"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_25"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_26"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_27"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_28"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_29"></txt>
              </td>
              <td class="cell">
                <txt :txt="d.DEF_ID_30"></txt>
              </td>
              <td style="border:1px solid grey;">
                <subject subject=""></subject>
              </td>
              <!-- <td style="border:1px solid grey;">
                <subject subject=""></subject>
              </td> -->
              <td style="border:1px solid grey;" class="text-right">
                <txt txt=""></txt>
              </td>
              <td style="border:1px solid grey;">
                <subject subject=""></subject>
              </td>
              <td style="border:1px solid grey;">
                <txt txt=""></txt>
              </td>
            </tr>
            <tr>
              <td style="border:0px solid grey;">

              </td>
              <td style="border:1px solid grey;">
                <subject subject="Point"></subject>
              </td>

              <td class="cell">
                <txt :txt="(d.DEF_POINT_01==0)?'':d.DEF_POINT_01"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_02==0)?'':d.DEF_POINT_02"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_03==0)?'':d.DEF_POINT_03"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_04==0)?'':d.DEF_POINT_04"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_05==0)?'':d.DEF_POINT_05"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_06==0)?'':d.DEF_POINT_06"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_07==0)?'':d.DEF_POINT_07"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_08==0)?'':d.DEF_POINT_08"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_09==0)?'':d.DEF_POINT_09"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_10==0)?'':d.DEF_POINT_10"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_11==0)?'':d.DEF_POINT_11"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_12==0)?'':d.DEF_POINT_12"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_13==0)?'':d.DEF_POINT_13"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_14==0)?'':d.DEF_POINT_14"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_15==0)?'':d.DEF_POINT_15"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_16==0)?'':d.DEF_POINT_16"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_17==0)?'':d.DEF_POINT_17"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_18==0)?'':d.DEF_POINT_18"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_19==0)?'':d.DEF_POINT_19"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_20==0)?'':d.DEF_POINT_20"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_21==0)?'':d.DEF_POINT_21"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_22==0)?'':d.DEF_POINT_22"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_23==0)?'':d.DEF_POINT_23"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_24==0)?'':d.DEF_POINT_24"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_25==0)?'':d.DEF_POINT_25"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_26==0)?'':d.DEF_POINT_26"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_27==0)?'':d.DEF_POINT_27"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_28==0)?'':d.DEF_POINT_28"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_29==0)?'':d.DEF_POINT_29"></txt>
              </td>
              <td class="cell">
                <txt :txt="(d.DEF_POINT_30==0)?'':d.DEF_POINT_30"></txt>
              </td>
              <td style="border:1px solid grey;" class="text-center">
                <subject :subject="d.SUM_DEF_POINT"></subject>
              </td>
              <!-- <td style="border:1px solid grey;" class="text-center">
                <subject subject=""></subject>
              </td> -->
              <td style="border:1px solid grey;" class="text-right">
                <txt txt=""></txt>
              </td>
              <td style="border:1px solid grey;">
                <subject subject=""></subject>
              </td>
              <td style="border:1px solid grey;">
                <txt txt=""></txt>
              </td>
            </tr>
            <tr>
              <td >

              </td>
              <td style="border:1px solid grey;">
                <subject subject="Remark"></subject>
              </td>
              <td colspan="34" style="border:1px solid grey;">
                <txt :txt="d.REMARK"></txt>
              </td>
            </tr>
          </template>

        </table>
        <div v-show="(n==r.lines.length)">
          <table style="width:100%;border:1px solid grey;border-collapse: collapse;">
            <tr>
              <td>
                <subject subject="Total Defect Group / Point -> "></subject>
                <span v-for="j in r.total" v-bind:key="j.G_DEFECT_GROUP">
                  <subject :subject="j.G_DEFECT_GROUP"></subject>
                  <subject :subject="j.G_CHK_POINT"></subject>
                  <subject subject="Point : "></subject>
                </span>

              </td>
            </tr>
            <tr>
              <td>
                <subject subject="Supervised by :"></subject>
                <txt :txt="r.EMP_NAME"></txt>
              </td>
            </tr>
          </table>
        </div>
      </databody>
      <!-- <footer>
      footer
    </footer> -->
    </page>
  </template>
</div>
</template>

<script>
import axios from 'axios'

import txt from '../components/Txt'
import subject from '../components/Title'
export default {
  components: {
    txt,
    subject
  },
  data() {
    return {
      r: {}

    }
  },
  mounted() {
    this.QueryData()
  },
  methods: {
    async QueryData() {
      let params = new FormData()
      params.append("ou", this.$route.params.ou)
      params.append("batch", this.$route.params.batch)
      await axios({
        method: "post",
        url: this.$api + "qt2.php/inspec",
        data: params
      }).then(res => {
        console.log(res.data)
        console.log(res.data.lines.length)
        this.r = res.data
      });
    }
  }
}
</script>

<style scoped>
body {
  background: rgb(204, 204, 204);
}

page {
  position: relative;
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
}

page[size="A4"] {
  height: 21cm;
  width: 29.7cm;
}

.subject {
  font-size: 11px;
  font-weight: bold;
  padding: 3px;
  display: inline-block;
}

.txt {
  font-size: 8px;
  font-weight: normal;
  padding: 3px;
  display: inline-block;

}

header {
  position: absolute;
  left: 0;
  right: 0;
  background-color: #fff;
  padding-right: 0.5cm;
  padding-left: 0.5cm;
}

footer {
  position: absolute;
  left: 0;
  right: 0;
  background-color: #ccc;
  padding-right: 0.5cm;
  padding-left: 0.5cm;
}

databody {
  position: absolute;
  left: 0;
  right: 0;
  top: 94px;

  padding-top: 7mm;
  padding-right: 0.5cm;
  padding-left: 0.5cm;
}

/* header:after{
  content: "Header";
}
footer:after{
  content: "Footer";
} */

header {
  top: 0;
  padding-top: 5mm;
  padding-bottom: 0mm;
}

/* databody {
  top: 70px;
  padding-top: 5mm;
  padding-bottom: 0mm;
} */

footer {
  bottom: 0;
  color: #000;
  padding-top: 3mm;
  padding-bottom: 5mm;
}

.cell {
  border: 1px solid grey;

  width: 8px;
}

@media print {

  body,
  page {
    margin: 0;
    box-shadow: 0;
  }

  header,
  footer {
    position: fixed;
    left: 0;
    right: 0;
    background-color: #ccc;
    padding-right: 0.5cm;
    padding-left: 0.5cm;
  }
}
</style>
