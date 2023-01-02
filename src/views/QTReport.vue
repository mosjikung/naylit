<template>
  <div>
    <page size="A4">
      <div style="margin: 0 auto; width: 98%">
        <table
          style="
            width: 100%;
            border: 0px solid black;
            border-collapse: collapse;
          "
        >
          <tr>
            <td colspan="4">
              <div style="width: 100%; text-align: center">
                <subject subject="Nanyang Kniting"></subject>
              </div>
              <div style="width: 100%; text-align: center">
                <subject subject="Quality Test"></subject>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <subject subject="Cus. Name :"></subject>
              <txt :txt="r.CUSTOMER_DESC"></txt>
            </td>
          </tr>
          <tr>
            <td style="width: 35%">
              <subject subject="DH :"></subject>
              <txt :txt="r.OU_CODE"></txt>
            </td>
            <td style="width: 25%">
              <subject subject="Batch No :"></subject>
              <txt :txt="r.BATCH_NO"></txt>
            </td>
            <td style="width: 25%">
              <subject subject="Result Date :"></subject>
              <txt :txt="r.RESULT_DATE"></txt>
            </td>
            <td style="width: 15%">
              <subject subject="Buy :"></subject>
              <txt :txt="r.BUYYER"></txt>
            </td>
          </tr>
          <tr>
            <td>
              <subject subject="End Cus Name :"></subject>
              <txt :txt="r.CUSTOMER_REF_DESC"></txt>
            </td>
            <td>
              <subject subject="Weight :"></subject>
              <txt :txt="r.WEIGHT_G"></txt>
            </td>
            <td>
              <subject subject="Request Date :"></subject>
              <txt :txt="r.APPOINT_DATE"></txt>
            </td>
            <td>
              <subject subject="Season :"></subject>
              <txt :txt="r.SEASON"></txt>
            </td>
          </tr>
          <tr>
            <td>
              <subject subject="Item :"></subject>
              <txt :txt="r.ITEM_DESC"></txt>
            </td>
            <td>
              <subject subject="Width :"></subject>
              <txt :txt="r.WIDTH"></txt>
            </td>
            <td>
              <subject subject="No Results :"></subject>
              <txt :txt="r.QT_NO"></txt>
            </td>
            <td></td>
          </tr>
          <tr>
            <td>
              <subject subject="Color :"></subject>
              <txt :txt="r.COLOR_DESC"></txt>
            </td>
            <td>
              <subject subject="PO No :"></subject>
              <txt :txt="r.PO_NO"></txt>
            </td>
            <td></td>
            <td>
             </td>
          </tr>
          <tr>
            <td colspan="4">
              <subject subject="Spec Item develop :"></subject>
              <txt txt=""></txt>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <subject subject="Fabric Width Method :"></subject>
              <txt :txt="r.FABRIC_WIDTH_METHOD"></txt>
            </td>
          </tr>
        </table>
      </div>
      <div style="margin: 0 auto; width: 98%">
        <table
          style="
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
          "
        >
          <tr>
            <th style="width: 12%; border: 1px solid black">Type of Method</th>
            <th style="width: 44%; border: 1px solid black">
              Quality Test (Result)
            </th>
            <th style="width: 44%; border: 1px solid black">
              Customer Requirement Information
            </th>
          </tr>
          <tr>
            <td style="border: 1px solid black; vertical-align: top">
              <table style="width: 100%">
                <tr>
                  <td style="text-align: center"><b>Shrinkage Method</b></td>
                </tr>
                <tr>
                  <td style="text-align: center"><b>Wash Temp.</b></td>
                </tr>
                <tr>
                  <td style="text-align: center"><b>Drying</b></td>
                </tr>
                <tr>
                  <td></td>
                </tr>
              </table>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <table style="width: 100%">
                <tr>
                  <td>
                    <txt :txt="r.SHINKAGE_METHOD"></txt>
                  </td>
                  <td style="text-align: right">
                    <b>After</b>
                  </td>
                  <td style="text-align: right">
                    <b>% Sh-Ln</b>
                  </td>
                  <td style="text-align: right">
                    <b>% Sh-Wd</b>
                  </td>
                </tr>
                <tr>
                  <td>
                    <txt :txt="r.WASH_TEMP" :tempC="true"></txt>
                  </td>
                  <td style="text-align: right">
                    <b>1 Wash Cycle</b>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="r.WASH1_CYCLE_LN"></txt>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="r.WASH1_CYCLE_WD"></txt>
                  </td>
                </tr>
                <tr>
                  <td>
                    <txt :txt="r.DRYING"></txt>
                  </td>
                  <td style="text-align: right">
                    <b>3 Wash Cycle</b>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="r.WASH3_CYCLE_LN"></txt>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="r.WASH3_CYCLE_WD"></txt>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td style="text-align: right">
                    <b>5 Wash Cycle</b>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="r.WASH5_CYCLE_LN"></txt>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="r.WASH5_CYCLE_WD"></txt>
                  </td>
                </tr>
              </table>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <table style="width: 50%">
                <tr>
                  <td style="text-align: right; width: 5%" class="text-white">
                    <subject subject="."></subject>
                  </td>
                  <td style="text-align: right">
                    <subject subject="% Sh-Ln"></subject>
                  </td>
                  <td style="text-align: right">
                    <subject subject="% Sh-Wd"></subject>
                  </td>
                </tr>
                <tr>
                  <td style="text-align: right" class="text-white">
                    <subject subject="."></subject>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="q.WASH1_CYCLE_M_LN"></txt>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="q.WASH1_CYCLE_M_WD"></txt>
                  </td>
                </tr>
                <tr>
                  <td style="text-align: right" class="text-white">
                    <subject subject="."></subject>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="q.WASH3_CYCLE_M_LN"></txt>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="q.WASH3_CYCLE_M_WD"></txt>
                  </td>
                </tr>
                <tr>
                  <td style="text-align: right" class="text-white">
                    <subject subject="."></subject>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="q.WASH5_CYCLE_M_LN"></txt>
                  </td>
                  <td style="text-align: right">
                    <txt :txt="q.WASH5_CYCLE_M_WD"></txt>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Fabric (Inch) Width"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <div class="fl" style="width: 33%">
                  <subject subject="Tabular :"></subject>
                  <txt :txt="r.TABULAR_WD_RESULT"></txt>
                </div>

                <div class="fl" style="width: 33%">
                  <subject subject="Open :"></subject>
                  <txt :txt="r.OPEN_WD_RESULT"></txt>
                </div>
                <div class="fl" style="width: 33%">
                  <subject subject="Weight :"></subject>
                  <txt :txt="r.WEIGHT_RESULT"></txt>
                  <txt txt="g/m2"></txt>
                </div>
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <div class="fl" style="width: 33%">
                  <subject subject="Tabular :"></subject>
                  <txt :txt="q.TABULAR_WD_RESULT_M"></txt>
                </div>

                <div class="fl" style="width: 33%">
                  <subject subject="Open :"></subject>
                  <txt :txt="q.OPEN_WD_RESULT_M"></txt>
                </div>
                <div class="fl" style="width: 33%">
                  <subject subject="Weight :"></subject>
                  <txt :txt="q.WEIGHT_RESULT_M"></txt
                  >
                  <txt txt="g/m2"></txt>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Absorbency Method"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 25%" :txt="r.ABSORB_METHOD"></txt>
                <subject subject="Before Wash"></subject>
                <txt style="width: 25%" :txt="r.BEFORE_WASH"></txt>
                <txt txt="sec."></txt>
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div class="fl" style="width: 50%">
                <subject subject="Before Wash"></subject>
                <txt :txt="q.BEFORE_WASH_M"></txt
                >
                <txt txt="sec."></txt>
              </div>
              <div class="fl" style="width: 50%">
                <subject subject="After Wash"></subject>
                <txt :txt="q.AFTER_WASH_M"></txt
                >
                <txt txt="sec."></txt>
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="%Spirality Method"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 50%" :txt="r.SPL_METHOD"></txt>
                <subject subject="Before"></subject>
                <txt :txt="r.SPL_METHOD"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 25%"></txt>
                <subject subject="1 After"></subject>
                <txt style="width: 15%" :txt="r.OFF_GRAIN_AFTER1"></txt>
                <subject subject="3 After"></subject>
                <txt style="width: 15%" :txt="r.OFF_GRAIN_AFTER3"></txt>
                <subject subject="5 After"></subject>
                <txt style="width: 15%" :txt="r.OFF_GRAIN_AFTER5"></txt>
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <subject subject="Before"></subject>
                <txt :txt="q.SPL_BRFORE_PERCEN_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject subject="1 After"></subject>
                <txt style="width: 15%" :txt="q.SPL_AFTER1_M"></txt
                >
                <subject subject="3 After"></subject>
                <txt style="width: 15%" :txt="q.SPL_AFTER3_M"></txt
                >
                <subject subject="5 After"></subject>
                <txt style="width: 15%" :txt="q.SPL_AFTER5_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Off Grain (Degree)"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 25%" txt=""></txt>
                <subject subject="Before"></subject>
                <txt :txt="r.OFF_GRAIN_BRFORE"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 25%" txt=""></txt>
                <subject subject="1 After"></subject>
                <txt style="width: 15%" :txt="r.OFF_GRAIN_AFTER1"></txt>
                <subject subject="3 After"></subject>
                <txt style="width: 15%" :txt="r.OFF_GRAIN_AFTER3"></txt>
                <subject subject="5 After"></subject>
                <txt style="width: 15%" :txt="r.OFF_GRAIN_AFTER5"></txt>
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <subject subject="Before"></subject>
                <txt :txt="q.OFF_GRAIN_BRFORE_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject subject="1 After"></subject>
                <txt style="width: 15%" :txt="q.OFF_GRAIN_AFTER1_M"></txt
                >
                <subject subject="3 After"></subject>
                <txt style="width: 15%" :txt="q.OFF_GRAIN_AFTER3_M"></txt
                >
                <subject subject="5 After"></subject>
                <txt style="width: 15%" :txt="q.OFF_GRAIN_AFTER5_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="
                border: 0px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Stretch & Recovery Method"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 20%" :txt="r.STRETCH_METHOD"></txt>
              
                <subject style="width: 20%" subject="Stretch(%)"></subject>
                <subject style="width: 15%" subject="Width"></subject>
                <txt style="width: 15%" :txt="r.STRETCH_WD"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="r.STRETCH_WD_P"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <subject style="width: 20%" subject=""></subject>
                <subject style="width: 15%" subject="Length"></subject>
                <txt style="width: 15%" :txt="r.STRETCH_LN"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="r.STRETCH_LN_P"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <subject style="width: 20%" subject="Stretch(%)"></subject>
                <subject style="width: 15%" subject="Width"></subject>
                <txt style="width: 15%" :txt="q.STRETCH_WD_M"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="q.STRETCH_WD_P_M"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <subject style="width: 20%" subject=""></subject>
                <subject style="width: 15%" subject="Length"></subject>
                <txt style="width: 15%" :txt="q.STRETCH_LN_M5"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="q.STRETCH_LN_P_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="
                border: 0px solid black;
                vertical-align: top;
                text-align: center;
              "
            ></td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <subject style="width: 20%" subject="Recovery(%)"></subject>
                <subject style="width: 15%" subject="Width"></subject>
                <txt style="width: 15%" :txt="r.RECOVERY_WD"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="r.RECOVERY_WD_P"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <subject style="width: 20%" subject=""></subject>
                <subject style="width: 15%" subject="Length"></subject>
                <txt style="width: 15%" :txt="r.RECOVERY_LN"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="r.RECOVERY_LN_P"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <subject style="width: 20%" subject="Recovery(%)"></subject>
                <subject style="width: 15%" subject="Width"></subject>
                <txt style="width: 15%" :txt="q.RECOVERY_WD_M"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="q.RECOVERY_WD_P_M"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <subject style="width: 20%" subject=""></subject>
                <subject style="width: 15%" subject="Length"></subject>
                <txt style="width: 15%" :txt="q.RECOVERY_LN_M"></txt
                >
                <subject style="width: 15%" subject="Result"></subject>
                <txt style="width: 15%" :txt="q.RECOVERY_LN_P_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Wicking Method"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 100%" :txt="r.WICKING_METHOD"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 10%" subject="Before"></subject>
                <txt style="width: 5%" txt=""></txt>
                <subject style="width: 13%" subject=""></subject>
                <subject style="width: 20%" subject="Wicking"></subject>
                <txt style="width: 15%" :txt="r.WICKING"></txt
                >
                <txt style="width: 15%" :txt="r.WICKING_WD"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="r.WICKING_UNIT"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 10%" subject="After"></subject>
                <txt style="width: 5%" :txt="r.WICKING_AFTER_X1_WASH"></txt
                >
                <subject style="width: 13%" subject="Wash"></subject>
                <subject style="width: 20%" subject="Wicking"></subject>
                <txt style="width: 15%" :txt="r.WICKING_AFTER"></txt
                >
                <txt style="width: 15%" :txt="r.WICKING_WD_AFTER"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="r.WICKING_UNIT"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 20%" subject="%Evaporation"></subject>
                <txt style="width: 30%" :txt="r.WICKING_EVA_P"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="r.WICKING_EVA_P_UNIT"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%" class="text-white">
                <txt style="width: 30%" txt="."></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 10%" subject="Before"></subject>
                <txt style="width: 5%" txt=""></txt
                >
                <subject style="width: 10%" subject=""></subject>
                <subject style="width: 20%" subject="Wicking"></subject>
                <txt style="width: 15%" :txt="q.WICKING_M"></txt
                >
                <txt style="width: 15%" :txt="q.WICKING_WD_M"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="q.WICKING_UNIT_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 10%" subject="After"></subject>
                <txt style="width: 5%" :txt="q.WICKING_AFTER_X1_WASH_M"></txt
                >
                <subject style="width: 10%" subject="Wash"></subject>
                <subject style="width: 20%" subject="Wicking"></subject>
                <txt style="width: 15%" :txt="q.WICKING_AFTER_M"></txt
                >
                <txt style="width: 15%" :txt="q.WICKING_WD_AFTER_M"></txt
                >

                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="q.WICKING_UNIT_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 20%" subject="%Evaporation"></subject>
                <txt style="width: 30%" :txt="q.WICKING_EVA_P_M"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="q.WICKING_EVA_P_UNIT_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="border: 1px solid black; text-align: center; padding: 0px"
            >
              <b>Water/Vapour Method</b>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 30%" :txt="r.WATER_EVA_METHOD"></txt
                >
                <subject style="width: 20%" subject="%Evaporation"></subject>
                <txt style="width: 30%" :txt="r.WATER_EVA_PERCEN"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 10%" :txt="r.WATER_EVA_UNIT"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
               
                <subject style="width: 20%" subject="%Evaporation"></subject>
                <txt style="width: 30%" :txt="q.WATER_EVA_PERCEN_M"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="q.WATER_EVA_UNIT_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="border: 1px solid black; text-align: center; padding: 0px"
            >
              <b>Bursting Method</b>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 30%" :txt="r.BURSTING_STRENGTH_METHOD"></txt
                >
                <subject style="width: 20%" subject="Bursting"></subject>
                <txt style="width: 15%" :txt="r.M1_BURSTING_TYPE"></txt
                >
                <txt style="width: 15%" :txt="r.M1_BURSTING"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 10%" :txt="r.M1_BURSTING_UNIT"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
               
                <subject style="width: 20%" subject="Bursting"></subject>
                <txt style="width: 15%" :txt="q.M1_BURSTING_TYPE_M"></txt
                >
                <txt style="width: 15%" :txt="q.M1_BURSTING_M"></txt
                >
                <subject style="width: 7%" subject="Unit"></subject>
                <txt style="width: 15%" :txt="q.M1_BURSTING_UNIT_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="
                border: 1px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            >
              <subject subject="Color Fastness To"></subject>
              <div style="padding-top: 2px">Color Staining</div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Method"></subject>
                <txt style="width: 75%" :txt="r.M1_METHOD_NAME"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt
                  style="width: 25%"
                  :txt="r.M1_WASH_TEMP"
                  :tempC="true"
                ></txt
                >
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="r.M1_COLOR_CHANGE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_ACETATE"></txt
                >
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_NYLON"></txt
                >
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_ACRYLIC"></txt
                >
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_VISCOSE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_COTTON"></txt
                >
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_POLYESTER"></txt
                >
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_SILK"></txt
                >
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="r.M1_ST_WOOL"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%" class="text-white">
                <subject style="width: 23%" subject="."></subject>
                <txt style="width: 75%" txt=""></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt
                  style="width: 25%"
                  :txt="q.M1_WASH_TEMP_M"
                  :tempC="true"
                ></txt
                >
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.M1_COLOR_CHANGE_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_ACETATE_M"></txt
                >
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_NYLON_M"></txt
                >
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_ACRYLIC_M"></txt
                >
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_VISCOSE_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_COTTON_M"></txt
                >
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_POLYESTER_M"></txt
                >
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_SILK_M"></txt
                >
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="q.M1_ST_WOOL_M"></txt
                >
              </div>
            </td>
          </tr>

          <tr>
            <td
              style="
                border: 1px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            >
              <div style="padding-top: 24px">Color Staining</div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 23%" subject="Water Method"></subject>
                <txt style="width: 75%" :txt="r.M2_METHOD_NAME"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt
                  style="width: 25%"
                  :txt="r.M2_WASH_TEMP"
                  :tempC="true"
                ></txt
                >
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="r.M2_COLOR_CHANGE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_ACETATE"></txt
                >
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_NYLON"></txt
                >
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_ACRYLIC"></txt
                >
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_VISCOSE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_COTTON"></txt
                >
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_POLYESTER"></txt
                >
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_SILK"></txt
                >
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="r.M2_ST_WOOL"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%" class="text-white">
                <subject style="width: 23%" subject="."></subject>
                <txt style="width: 75%" txt=""></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt style="width: 25%" :txt="q.M2_WASH_TEMP_M"></txt
                >
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.M2_COLOR_CHANGE_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_ACETATE_M"></txt
                >
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_NYLON_M"></txt
                >
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_ACRYLIC_M"></txt
                >
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_VISCOSE_M"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_COTTON_M"></txt
                >
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_POLYESTER_M"></txt
                >
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_SILK_M"></txt
                >
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="q.M2_ST_WOOL_M"></txt
                >
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            >
              <div style="padding-top: 24px">Color Staining</div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 23%" subject="Actual Method"></subject>
                <txt style="width: 75%" :txt="r.M3_METHOD_NAME"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt
                  style="width: 25%"
                  :txt="r.M3_WASH_TEMP"
                  :tempC="true"
                ></txt
                >
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="r.M3_COLOR_CHANGE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_ACETATE"></txt
                >
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_NYLON"></txt
                >
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_ACRYLIC"></txt
                >
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_VISCOSE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_COTTON"></txt
                >
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_COTTON"></txt
                >
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_SILK"></txt
                >
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="r.M3_ST_WOOL"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%" class="text-white">
                <subject style="width: 23%" subject="."></subject>
                <txt style="width: 75%" txt=""></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt style="width: 25%" :txt="q.M3_WASH_TEMP_M"></txt>
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.M3_COLOR_CHANGE_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_ACETATE_M"></txt>
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_NYLON_M"></txt>
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_ACRYLIC_M"></txt>
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_VISCOSE_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_COTTON_M"></txt>
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_POLYESTER_M"></txt>
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_SILK_M"></txt>
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="q.M3_ST_WOOL_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            >
              <div style="padding-top: 24px">Color Staining</div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject
                  style="width: 30%"
                  subject="Perspiration Method"
                ></subject>
                <txt style="width: 70%" :txt="r.M4_METHOD_NAME"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt
                  style="width: 25%"
                  :txt="r.M4_WASH_TEMP"
                  :tempC="true"
                ></txt
                >
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="r.M4_COLOR_CHANGE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_ACETATE"></txt
                >
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_NYLON"></txt
                >
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_ACRYLIC"></txt
                >
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_VISCOSE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_COTTON"></txt
                >
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_COTTON"></txt
                >
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_SILK"></txt
                >
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="r.M4_ST_WOOL"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%" class="text-white">
                <subject style="width: 23%" subject="."></subject>
                <txt style="width: 75%" txt=""></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 23%" subject="Washing Temp."></subject>
                <txt style="width: 25%" :txt="q.M4_WASH_TEMP_M"></txt>
                <subject style="width: 23%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.M4_COLOR_CHANGE_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Acelate"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_ACETATE_M"></txt>
                <subject style="width: 12%" subject="Nylon"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_NYLON_M"></txt>
                <subject style="width: 12%" subject="Acrylic"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_ACRYLIC_M"></txt>
                <subject style="width: 12%" subject="Viscose"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_VISCOSE_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 12%" subject="Cotton"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_COTTON_M"></txt>
                <subject style="width: 12%" subject="Poly"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_POLYESTER_M"></txt>
                <subject style="width: 12%" subject="Silk"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_SILK_M"></txt>
                <subject style="width: 12%" subject="Wool"></subject>
                <txt style="width: 12%" :txt="q.M4_ST_WOOL_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="border: 0px solid black; text-align: center; padding: 0px"
            ></td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject
                style="width: 35%"
                subject="Chlorine Bleaching Method"
              ></subject>
              <txt style="width: 20%" :txt="r.CHLORINE_BLEACHING"></txt
              >
              <subject style="width: 25%" subject="Color Change"></subject>
              <txt style="width: 15%" :txt="r.CHLORINE_BLEACHING_COLOR"></txt
              >
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject style="width: 25%" subject="Color Change"></subject>
              <txt style="width: 15%" :txt="q.CHLORINE_BLEACHING_COLOR_M"></txt>
            </td>
          </tr>
          <tr>
            <td
              style="border: 0px solid black; text-align: center; padding: 0px"
            ></td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject
                style="width: 35%"
                subject="Non Chlorine Bleaching"
              ></subject>
              <txt style="width: 20%" :txt="r.NON_CHLORIN_BLEACHING"></txt
              >
              <subject style="width: 25%" subject="Color Change"></subject>
              <txt
                style="width: 15%"
                :txt="r.NON_CHLORINE_BELACHING_COLOR"
              ></txt
              >
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject style="width: 25%" subject="Color Change"></subject>
              <txt
                style="width: 15%"
                :txt="q.NON_CHLORINE_BELACHING_COLOR_M"
              ></txt>
            </td>
          </tr>
          <tr>
            <td
              style="border: 0px solid black; text-align: center; padding: 0px"
            ></td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject
                style="width: 35%"
                subject="Chlorinated Water Method"
              ></subject>
              <txt style="width: 20%" :txt="r.CHLORINE_WATER"></txt
              >
              <subject style="width: 25%" subject="Color Change"></subject>
              <txt style="width: 15%" :txt="r.CHLORINE_WATER_COLOR"></txt
              >
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject style="width: 25%" subject="Color Change"></subject>
              <txt style="width: 15%" :txt="q.CHLORINE_WATER_COLOR_M"></txt>
            </td>
          </tr>
        </table>
      </div>
    </page>
    <br>

    <page size="A4">
      <div style="margin: 0 auto; width: 98%">
        <table
          style="
            width: 100%;
            border: 0px solid black;
            border-collapse: collapse;
          "
        >
          <tr>
            <td colspan="4">
              <div style="width: 100%; text-align: center">
                <subject subject="Nanyang Kniting"></subject>
              </div>
              <div style="width: 100%; text-align: center">
                <subject subject="Quality Test"></subject>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <subject subject="Cus. Name :"></subject>
              <txt :txt="r.CUSTOMER_DESC"></txt>
            </td>
          </tr>

          <tr>
            <td style="width: 35%">
              <subject subject="DH :"></subject>
              <txt :txt="r.OU_CODE"></txt>
            </td>
            <td style="width: 25%">
              <subject subject="Batch No :"></subject>
              <txt :txt="r.BATCH_NO"></txt>
            </td>
            <td style="width: 25%">
              <subject subject="Result Date :"></subject>
              <txt :txt="r.RESULT_DATE"></txt>
            </td>
            <td style="width: 15%">
              <subject subject="Buy :"></subject>
              <txt :txt="r.BUYYER"></txt>
            </td>
          </tr>
          <tr>
            <td>
              <subject subject="End Cus Name :"></subject>
              <txt :txt="r.CUSTOMER_REF_DESC"></txt>
            </td>
            <td>
              <subject subject="Weight :"></subject>
              <txt :txt="r.WEIGHT_G"></txt>
            </td>
            <td>
              <subject subject="Request Date :"></subject>
              <txt :txt="r.APPOINT_DATE"></txt>
            </td>
            <td>
              <subject subject="Season :"></subject>
              <txt :txt="r.SEASON"></txt>
            </td>
          </tr>
          <tr>
            <td>
              <subject subject="Item :"></subject>
              <txt :txt="r.ITEM_DESC"></txt>
            </td>
            <td>
              <subject subject="Width :"></subject>
              <txt :txt="r.WIDTH"></txt>
            </td>
            <td>
              <subject subject="No Results :"></subject>
              <txt :txt="r.QT_NO"></txt>
            </td>
            <td></td>
          </tr>
          <tr>
            <td>
              <subject subject="Color :"></subject>
              <txt :txt="r.COLOR_DESC"></txt>
            </td>
            <td>
              <subject subject="PO No :"></subject>
              <txt :txt="r.PO_NO"></txt>
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="4">
              <subject subject="Spec Item develop :"></subject>
              <txt txt=""></txt>
            </td>
          </tr>
        </table>
      </div>
      <div style="margin: 0 auto; width: 98%">
        <table
          style="
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
          "
        >
          <tr>
            <th style="width: 12%; border: 1px solid black">Type of Method</th>
            <th style="width: 44%; border: 1px solid black">
              Quality Test (Result)
            </th>
            <th style="width: 44%; border: 1px solid black">
              Customer Requirement Information
            </th>
          </tr>
          <tr>
            <td
              style="
                border: 0px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            ></td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 25%" subject="Rubbling Method"></subject>
                <txt style="width: 75%" :txt="r.RUBBING_CROCKING"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="Dry Before Wash"></subject>
                <txt style="width: 25%" :txt="r.DRY_RUB_BEFORE"></txt
                >
                <subject style="width: 25%" subject="Wet Before Wash"></subject>
                <txt style="width: 25%" :txt="r.WET_RUB_BEFORE"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="After Wash"></subject>
                <txt style="width: 25%" :txt="r.DRY_RUB_AFTER"></txt
                >
                <subject style="width: 25%" subject="After Wash"></subject>
                <txt style="width: 25%" :txt="r.WET_RUB_AFTER"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%" class="text-white">
                <subject style="width: 30%" subject="."></subject>
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="Dry Before Wash"></subject>
                <txt style="width: 25%" :txt="q.DRY_RUB_BEFORE_M"></txt>
                <subject style="width: 25%" subject="Wet Before Wash"></subject>
                <txt style="width: 25%" :txt="q.WET_RUB_BEFORE_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="After Wash"></subject>
                <txt style="width: 25%" :txt="q.DRY_RUB_AFTER_M"></txt>
                <subject style="width: 25%" subject="After Wash"></subject>
                <txt style="width: 25%" :txt="q.WET_RUB_AFTER_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="border: 0px solid black; text-align: center; padding: 0px"
            ></td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject
                style="width: 35%"
                subject="Flammability Method"
              ></subject>
              <txt style="width: 20%" :txt="r.FLAMMABITY"></txt
              >
              <subject style="width: 25%" subject="Class"></subject>
              <txt style="width: 15%" :txt="r.FLAMMABITY_RESULT"></txt
              >
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject style="width: 25%" subject="Class"></subject>
              <txt style="width: 15%" :txt="q.FLAMMABITY_RESULT_M"></txt>
            </td>
          </tr>
          <tr>
            <td
              style="border: 0px solid black; text-align: center; padding: 0px"
            ></td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject style="width: 35%" subject="Perborate Method"></subject>
              <txt style="width: 20%" :txt="r.PERBORATE"></txt
              >
              <subject style="width: 25%" subject="Class"></subject>
              <txt style="width: 15%" :txt="r.PERBORATE_COLOR"></txt
              >
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <subject style="width: 25%" subject="Color Change"></subject>
              <txt style="width: 15%" :txt="q.PERBORATE_COLOR_M"></txt>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 0px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            ></td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 20%" subject="Light Method"></subject>
                <txt style="width: 50%" :txt="r.LIGHT"></txt
                >
                <subject style="width: 20%" subject="Exposed Time"></subject>
                <txt style="width: 10%" :txt="r.LIGHT_EXPOSED"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 35%" subject=""></subject>
                <txt style="width: 35%" txt=""></txt>
                <subject style="width: 20%" subject="Color Change"></subject>
                <txt style="width: 10%" :txt="r.LIGHT_COLOR"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 25%" subject="Exposed Time"></subject>
                <txt style="width: 25%" :txt="q.LIGHT_EXPOSED_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.LIGHT_COLOR_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 0px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            ></td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject
                  style="width: 35%"
                  subject="Wet-Alkaline Light Method"
                ></subject>
                <txt style="width: 35%" :txt="r.WET_ALKALINE">></txt
                >
                <subject style="width: 20%" subject="Exposed Time"></subject>
                <txt style="width: 10%" :txt="r.WET_ALKALINE_EXPOSED_TIME"
                  >></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 35%" subject=""></subject>
                <txt style="width: 35%" txt=""></txt>
                <subject style="width: 20%" subject="Color Change"></subject>
                <txt style="width: 10%" :txt="r.WET_ALKALINE_COLOR">></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 25%" subject="Exposed Time"></subject>
                <txt
                  style="width: 25%"
                  :txt="q.WET_ALKALINE_EXPOSED_TIME_M"
                ></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.WET_ALKALINE_COLOR_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 0px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            ></td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject
                  style="width: 35%"
                  subject="Light Perspiration Method"
                ></subject>
                <txt style="width: 35%" :txt="r.LIGHT_PER"></txt
                >
                <subject style="width: 20%" subject="Exposed Time"></subject>
                <txt style="width: 10%" :txt="r.LIGHT_PER_EXPOSED_TIME"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 35%" subject=""></subject>
                <txt style="width: 35%" txt=""></txt>
                <subject style="width: 20%" subject="Color Change"></subject>
                <txt style="width: 10%" :txt="r.LIGHT_PER_COLOR"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 25%" subject="Exposed Time"></subject>
                <txt style="width: 25%" :txt="q.LIGHT_PER_EXPOSED_TIME_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.LIGHT_PER_COLOR_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 0px solid black;
                text-align: center;
                padding: 0px;
                vertical-align: top;
              "
            ></td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject
                  style="width: 25%"
                  subject="Drycleaning Method"
                ></subject>
                <txt style="width: 45%" :txt="r.DRYCLEANING"></txt
                >
                <subject style="width: 20%" subject="Exposed Time"></subject>
                <txt style="width: 10%" :txt="r.DRYCLEANING_COLOR"></txt
                >
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject=""></subject>
                <txt style="width: 45%" txt=""></txt>
                <subject style="width: 20%" subject="Color Change"></subject>
                <txt style="width: 10%" :txt="r.DRYCLEANING_STAINING"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black">
              <div style="width: 100%">
                <subject style="width: 25%" subject="Exposed Time"></subject>
                <txt style="width: 25%" :txt="q.DRYCLEANING_COLOR_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 25%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.DRYCLEANING_STAINING_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="pH Method"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 70%" :txt="r.PH"></txt
                >
                <txt style="width: 30%" :txt="r.PH_RESULT"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 50%" :txt="q.PH_RESULT_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Phoenolic Yellowing"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <subject style="width: 70%" subject="(Courtauld)"></subject>
                <subject style="width: 20%" subject="Color Change"></subject>
                <txt style="width: 10%" :txt="r.PHENDIC_COLOR"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <subject style="width: 25%" subject="Color Change"></subject>
                <txt style="width: 25%" :txt="q.PHENDIC_COLOR_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Fomaldehyde Method"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 40%" :txt="r.FORMALDEHYE"></txt
                >
                <subject style="width: 20%" subject="Type"></subject>
                <subject style="width: 20%" subject="Result"></subject>
                <subject style="width: 20%" subject="Unit"></subject>
              </div>
              <div style="width: 100%">
                <txt style="width: 40%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FORMALDEHYE1_TYPE"></txt
                >
                <txt style="width: 20%" :txt="r.FORMALDEHYE1_RESULT"></txt
                >
                <txt style="width: 20%" :txt="r.FORMALDEHYE1_UNIT"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 40%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FORMALDEHYE2_TYPE"></txt
                >
                <txt style="width: 20%" :txt="r.FORMALDEHYE2_RESULT"></txt
                >
                <txt style="width: 20%" :txt="r.FORMALDEHYE2_UNIT"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 40%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FORMALDEHYE3_TYPE"></txt
                >
                <txt style="width: 20%" :txt="r.FORMALDEHYE3_RESULT"></txt
                >
                <txt style="width: 20%" :txt="r.FORMALDEHYE3_UNIT"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <subject style="width: 20%" subject="Result"></subject>
                <subject style="width: 20%" subject="Unit"></subject>
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" :txt="q.FORMALDEHYE1_RESULT_M"></txt>
                <txt style="width: 20%" :txt="q.FORMALDEHYE1_UNIT_M"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" :txt="q.FORMALDEHYE2_RESULT_M"></txt>
                <txt style="width: 20%" :txt="q.FORMALDEHYE2_UNIT_M"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" :txt="q.FORMALDEHYE3_RESULT_M"></txt>
                <txt style="width: 20%" :txt="q.FORMALDEHYE3_UNIT_M"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Fiber Content"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 40%" :txt="r.FIBER_CONTENT"></txt
                >
                <subject style="width: 20%" subject="100 % Content"></subject>
                <txt style="width: 20%" :txt="r.FIBER_100"></txt
                >
                <txt style="width: 15%" :txt="r.FIBER_100_PERCEN"></txt
                >
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 40%" txt=""></txt>
                <subject style="width: 20%" subject="% Blend"></subject>
                <txt style="width: 20%" :txt="r.FIBER_1"></txt
                >
                <txt style="width: 15%" :txt="r.FIBER_1_PERCEN"></txt
                >
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 60%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FIBER_2"></txt
                >
                <txt style="width: 15%" :txt="r.FIBER_2_PERCEN"></txt
                >
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 60%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FIBER_3"></txt
                >
                <txt style="width: 15%" :txt="r.FIBER_3_PERCEN"></txt
                >
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 60%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FIBER_4"></txt
                >
                <txt style="width: 15%" :txt="r.FIBER_4_PERCEN"></txt
                >
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 60%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FIBER_OTHER"></txt
                >
                <txt style="width: 15%" :txt="r.FIBER_OTHER_PERCEN"></txt
                >
                <txt style="width: 5%" txt="%"></txt>
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <subject style="width: 20%" subject="100 % Content"></subject>
                <txt style="width: 20%" :txt="r.FIBER_100_M"></txt>
                <txt style="width: 20%" :txt="r.FIBER_100_PERCEN_M"></txt>
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 20%" subject="% Blend"></subject>
                <txt style="width: 20%" :txt="r.FIBER_1_M"></txt>
                <txt style="width: 20%" :txt="r.FIBER_1_PERCEN_M"></txt>
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FIBER_2_M"></txt>
                <txt style="width: 20%" :txt="r.FIBER_2_PERCEN_M"></txt>
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FIBER_3_M"></txt>
                <txt style="width: 20%" :txt="r.FIBER_3_PERCEN_M"></txt>
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <txt style="width: 20%" :txt="r.FIBER_4_M"></txt>
                <txt style="width: 20%" :txt="r.FIBER_4_PERCEN_M"></txt>
                <txt style="width: 5%" txt="%"></txt>
              </div>
              <div style="width: 100%">
                <txt style="width: 20%" txt=""></txt>
                <txt style="width: 20%" txt="144"></txt>
                <txt style="width: 20%" txt="145"></txt>
                <txt style="width: 5%" txt="%"></txt>
              </div>
            </td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Light Source"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 50%" :txt="r.LIGHT_SOURCE"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top"></td>
          </tr>
          <tr>
            <td
              style="
                border: 1px solid black;
                vertical-align: top;
                text-align: center;
              "
            >
              <subject subject="Pilling Method"></subject>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <txt style="width: 40%" :txt="r.PILLING_METHOD"></txt
                >
                <subject style="width: 20%" subject=""></subject>
                <subject style="width: 20%" subject="Face"></subject>
                <subject style="width: 20%" subject="Back"></subject>
              </div>
              <div style="width: 100%">
                <txt style="width: 40%" txt=""></txt>
                <subject style="width: 20%" subject="Before Wash"></subject>
                <txt style="width: 20%" :txt="r.PILLING_FACE"></txt
                >
                <txt style="width: 20%" :txt="r.PILLING_BACK"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 40%" txt=""></txt>
                <subject style="width: 20%" subject="After Wash"></subject>
                <txt style="width: 20%" :txt="r.PILLING_FACE_AFTER"></txt
                >
                <txt style="width: 20%" :txt="r.PILLING_BACK_AFTER"></txt
                >
              </div>
              <div style="width: 100%">
                <txt style="width: 40%" txt=""></txt>
                <subject style="width: 20%" subject="Cycle/Time"></subject>
                <txt style="width: 20%" :txt="r.CYCLE_TIME"></txt
                >
              </div>
            </td>
            <td style="border: 1px solid black; vertical-align: top">
              <div style="width: 100%">
                <subject style="width: 20%" subject=""></subject>
                <subject style="width: 20%" subject="Face"></subject>
                <subject style="width: 20%" subject="Back"></subject>
              </div>
              <div style="width: 100%">
                <subject style="width: 20%" subject="Before Wash"></subject>
                <txt style="width: 20%" :txt="q.PILLING_FACE_M"></txt>
                <txt style="width: 20%" :txt="q.PILLING_BACK_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 20%" subject="After Wash"></subject>
                <txt style="width: 20%" :txt="q.PILLING_FACE_AFTER_M"></txt>
                <txt style="width: 20%" :txt="q.PILLING_BACK_AFTER_M"></txt>
              </div>
              <div style="width: 100%">
                <subject style="width: 20%" subject="Cycle/Time"></subject>
                <txt style="width: 20%" :txt="q.CYCLE_TIME_M"></txt>
              </div>
            </td>
          </tr>
        </table>
        <br/>
        <table
          style="
            border: 1px solid black;
            vertical-align: top;
            width: 60%;
            border-collapse: collapse;
          "
        >
          <tr>
            <th colspan="3" style="text-align: center">
              Snagging Resistance (Snag pod) Method:
            </th>
            <th
              style="border: 1px solid black; vertical-align: ; width: 50%"
              colspan="2"
            >
              {{ q2.SNAGGING_RESISTANCE_METHOD }}
            </th>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td style="text-align: center"><b>Face</b></td>
            <td style="text-align: center"><b>Back</b></td>
          </tr>
          <tr>
            <td style="text-align: center">Cycle(rvs.):</td>
            <td
              style="border: 1px solid black; vertical-align: top; width: 50px"
            >
              {{ q2.SNAGGING_CYCLE }}
            </td>
            <td class="text-right" style="padding-right:5px;">As Received&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_AS_RECEIVED_FACE }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_AS_RECEIVED_BACK }}
            </td>
          </tr>
          <tr>
           
            <td class="text-right" style="padding-right:5px;" colspan="3">Classification&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_CLASSIFICATION_FACE }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_CLASSIFICATION_BACK }}
            </td>
          </tr>
          <tr>
            <tr>
             <td style="text-align: center">Cycle(rvs.):</td>
            <td
              style="border: 1px solid black; vertical-align: top; width: 50px"
            >
              {{ q2.SNAGGING_CYCLE }}
            </td>
            <td class="text-right" style="padding-right:5px;" >Number Snag > 2mm&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_MORE_THAN2_FACE }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_MORE_THAN2_BACK }}
            </td>
          </tr>
          <tr>
            <td class="text-right" style="padding-right:5px;" colspan="3">Number Snag > 2 &lt; 5 mm&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ q2.SNAGGING_MORE_THAN5_FACE }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_MORE_THAN5_BACK }}
            </td>
          </tr>
          <tr>
            <td class="text-right" style="padding-right:5px;" colspan="3">Number Snag &lt; 5 mm&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_LESS_THAN5_FACE }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ q2.SNAGGING_LESS_THAN5_BACK }}
            </td>
          </tr>
        </table>
       </div>
</page>
<br>
<br>
<br>

    <page size="A4">
      <div style="margin: 0 auto; width: 98%">
        <table
          style="
            width: 100%;
            border: 0px solid black;
            border-collapse: collapse;
          "
        >
          <tr>
            <td colspan="4">
              <div style="width: 100%; text-align: center">
                <subject subject="Nanyang Kniting"></subject>
              </div>
              <div style="width: 100%; text-align: center">
                <subject subject="Quality Test"></subject>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <subject subject="Cus. Name :"></subject>
              <txt :txt="r.CUSTOMER_DESC"></txt>
            </td>
          </tr>

          <tr>
            <td style="width: 35%">
              <subject subject="DH :"></subject>
              <txt :txt="r.OU_CODE"></txt>
            </td>
            <td style="width: 25%">
              <subject subject="Batch No :"></subject>
              <txt :txt="r.BATCH_NO"></txt>
            </td>
            <td style="width: 25%">
              <subject subject="Result Date :"></subject>
              <txt :txt="r.RESULT_DATE"></txt>
            </td>
            <td style="width: 15%">
              <subject subject="Buy :"></subject>
              <txt :txt="r.BUYYER"></txt>
            </td>
          </tr>
          <tr>
            <td>
              <subject subject="End Cus Name :"></subject>
              <txt :txt="r.CUSTOMER_REF_DESC"></txt>
            </td>
            <td>
              <subject subject="Weight :"></subject>
              <txt :txt="r.WEIGHT_G"></txt>
            </td>
            <td>
              <subject subject="Request Date :"></subject>
              <txt :txt="r.APPOINT_DATE"></txt>
            </td>
            <td>
              <subject subject="Season :"></subject>
              <txt :txt="r.SEASON"></txt>
            </td>
          </tr>
          <tr>
            <td>
              <subject subject="Item :"></subject>
              <txt :txt="r.ITEM_DESC"></txt>
            </td>
            <td>
              <subject subject="Width :"></subject>
              <txt :txt="r.WIDTH"></txt>
            </td>
            <td>
              <subject subject="No Results :"></subject>
              <txt :txt="r.QT_NO"></txt>
            </td>
            <td></td>
          </tr>
          <tr>
            <td>
              <subject subject="Color :"></subject>
              <txt :txt="r.COLOR_DESC"></txt>
            </td>
            <td>
              <subject subject="PO No :"></subject>
              <txt :txt="r.PO_NO"></txt>
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="4">
              <subject subject="Spec Item develop :"></subject>
              <txt txt=""></txt>
            </td>
          </tr>
        </table>
      </div>
       <table
          style="
            border: 1px solid black;
            vertical-align: top;
            width: 100%;
            border-collapse: collapse;
          "
        >
          <tr>
            <th colspan="5" style="text-align: center">
              UV Protection Method:
            </th>
            <th
              style="border: 1px solid black; vertical-align: ; width: 60%"
              colspan="5"
            >
              {{ r.UV_PROTECTION_METHOD }}
            </th>
          </tr>
          <tr>
            <td colspan="5"></td>
            <td style="text-align: center"> &nbsp;</td>
            <td style="text-align: center"> &nbsp;</td>
            <td style="text-align: center"> &nbsp;</td>
          </tr>
          
          <tr>
             <td style="text-align: center">Wash Method:</td>
            <td
              style="border: 1px solid black; vertical-align: top; width: 50px"
            >
              {{ r.PROTECTION_WASH_METHOD }}
            </td>
            <td style="text-align: center">wash</td>
            
            <td class="text-right" style="padding-right:5px;"  colspan="2" >% Transmittance,T(UV-A):Dry&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top; width:20%;" >
              {{ r.PROTECTION_TRANS_UA_DRY}}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top width:30%;">
              {{ r.PROTECTION_TRANS_UA_DRY2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top width:30%;">
              {{ r.PROTECTION_TRANS_UA_DRY3 }}
            </td>
          </tr>
          <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">Wet&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UA_WET }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UA_WET2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UA_WET3 }}
            </td>
          </tr>
          <tr>
             <td style="text-align: center">As Recived After</td>
            <td
              style="border: 1px solid black; vertical-align: top; width: 70px "
            >
              {{ r.PROTECTION_AFTER_X1_WASH }}
            </td>
              <td style="text-align: center">wash</td>
            <td class="text-right" style="padding-right:5px;" colspan="2">% Transmittance,T(UV-B):Dry&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UB_DRY }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UB_DRY2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UB_DRY3 }}
            </td>
          </tr>
          <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">wet&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_TRANS_UB_WET }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UB_WET }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_TRANS_UB_WET3 }}
            </td>
          </tr>
          <tr>
             <td style="text-align: center">Wash After</td>
            <td
              style="border: 1px solid black; vertical-align: top; width: 50px"
            >
              {{ r.PROTECTION_AFTER_X2_WASH  }}
            </td>
            <td style="text-align: center">Wash</td>
            <td class="text-right" style="padding-right:5px;" colspan="2">%Blocking :UV-A :Dry&nbsp;:</td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UA_DRY }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UA_DRY2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UA_DRY3 }}
            </td>
          </tr>
          <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">Wet&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_BLOCKING_UA_WET }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UA_WET2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UA_WET3 }}
            </td>
          </tr>
          <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">%Blocking : UV-B :Dry:&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_BLOCKING_UB_DRY }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UB_DRY2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UB_DRY3 }}
            </td>
          </tr>
            <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">Wet&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_BLOCKING_UB_WET }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UB_WET2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_BLOCKING_UB_WET3 }}
            </td>
          </tr>
            <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">Mean UPF: Dry:&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_MEAN_UPF_DRY }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_MEAN_UPF_DRY2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_MEAN_UPF_DRY3 }}
            </td>
          </tr>
           <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">Wet&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_MEAN_UPF_WET }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_MEAN_UPF_WET2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_MEAN_UPF_WET3 }}
            </td>
          </tr>
           <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">Rated UPF: Dry:&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_RATED_UPF_DRY }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_RATED_UPF_DRY2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_RATED_UPF_DRY3 }}
            </td>
          </tr>
           <tr>
            <td class="text-right" style="padding-right:5px;" colspan="5">Wet&nbsp;:</td>
            <td class="text-center"  style="border: 1px solid black;">
              {{ r.PROTECTION_RATED_UPF_WET }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_RATED_UPF_WET2 }}
            </td>
            <td class="text-center" style="border: 1px solid black; vertical-align: top">
              {{ r.PROTECTION_RATED_UPF_WET3  }}
            </td>
          </tr>
        </table>
      </page>
  </div>
</template>

// 2480 pixels x 3508 pixels (print resolution)
// 595 pixels x 842 pixels (screen resolution)
// 794 pixels x 1123 pixels (screen resolution)

<script>
import axios from "axios";

import txt from "../components/Txt";
import subject from "../components/Title";
export default {
  components: {
    txt,
    subject,
  },
  data() {
    return {
      r: {},
      q: {},
      q2: {},
    };
  },
  mounted() {
    this.QueryData();
  },
  methods: {
    async QueryData() {
      let params = new FormData();
      params.append("ou", this.$route.params.ou);
      params.append("batch", this.$route.params.batch);
      await axios({
        method: "post",
        url: this.$api + "qt2.php/qt",
        data: params,
      }).then((res) => {
        console.log(res.data.QT2);
        this.r = res.data.Result;
        this.q = res.data.QT;
        this.q2 = res.data.QT2;
      });

    },
  },
};
</script>

<style scoped>
body {
  background: rgb(204, 204, 204);
}

page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  /* box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5); */
  font-size: 11px;
  font-family: "Oswald", sans-serif;
  font-weight: normal;
}

page[size="A4"] {
  width: 21cm;
  height: 29.7cm;
}

page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;
}

page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}

page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;
}

page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}

page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;
}

.layout {
  width: 98%;
  margin: 0 auto;
  padding-top: 5px;
}

@media print {
  body,
  page {
    margin: 0;
    box-shadow: 0;
  }
}

.brow {
  /* display: block; */
  /* border: 1px solid red; */
  width: 100%;
  padding: 0px;
}

.subject {
  font-size: 11px;
  font-weight: bold;
  padding: 3px;
  display: inline-block;
}

.txt {
  font-size: 11px;
  font-weight: normal;
  padding: 3px;
  display: inline-block;
}

.fl {
  float: left;
}

td {
  padding: 0px;
  border: 0px solid red;
}

/* 
.pa {
  padding: 1px;
  display: inline-block;
} */
</style>
