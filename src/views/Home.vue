<template>
<div>
  <div class="q-pa-md">

    <div class="row justify-center">
      <div class="col-12 col-md-3">
        <q-card class="my-card">
          <q-item class="bg-blue">
            <q-item-section avatar>
              <q-icon size="lg" name="shopping_cart" color="white" />
            </q-item-section>
            <q-item-section>
              <q-item-label class="text-h6  text-white">Customer Garment</q-item-label>
            </q-item-section>
          </q-item>
          <!-- <q-card-section class="bg-blue">
                        <div class="text-h6 text-white">Customer Garment</div>
                        <div class="text-subtitle2"></div>
                    </q-card-section> -->
          <q-separator />
          <q-card-actions vertical>
            <q-btn align="left" class="text-capitalize" color="green-6" color1="blue-6" @click="dialogPO=true">PO Customer</q-btn>
          </q-card-actions>
        </q-card>
      </div>
      <div class="col-12 col-md-3">
        <q-card class="my-card">
          <q-item class="bg-cyan">
            <q-item-section avatar>
              <q-icon size="lg" name="house" color="white" />
            </q-item-section>
            <q-item-section>
              <q-item-label class="text-h6  text-white">NAYLIT - Taiwan</q-item-label>
            </q-item-section>
          </q-item>
          <!-- <q-card-section class="bg-cyan">
                        <div class="text-h6  text-white">NAYLIT - Taiwan</div>
                        <div class="text-subtitle2"></div>
                    </q-card-section> -->
          <q-separator />
          <q-card-actions vertical>
            <q-btn align="left" class="text-capitalize" color="grey-6" color1="cyan-6" disable>Stock Raw Material</q-btn>
            <q-btn align="left" class="text-capitalize" color="grey-6" color1="cyan-6" disable>Issue Stock Raw Material</q-btn>
          </q-card-actions>
        </q-card>
      </div>
      <div class="col-12 col-md-3">
        <q-card class="my-card ">
          <q-item class="bg-green">
            <q-item-section avatar>
              <q-icon size="lg" name="house" color="white" />
            </q-item-section>
            <q-item-section>
              <q-item-label class="text-h6  text-white">NAYLIT - Thai</q-item-label>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-card-actions vertical>
            <q-btn align="left" class="text-capitalize" color="green-6" @click="dialogRMMove=true">Receive , Issue Raw Material</q-btn>
            <q-btn align="left" class="text-capitalize" color="green-6" @click="dialogRMStock=true">Stock Raw Material</q-btn>
            <q-btn align="left" class="text-capitalize" color="green-6" @click="dialogWIP=true">WIP Production Outstanding</q-btn>
            <q-btn align="left" class="text-capitalize" color="green-6" @click="dialogQT=true">Quality Test & Inspection Result</q-btn>
            <q-btn align="left" class="text-capitalize" color="green-6" @click="dialogFG=true">Warehouse FG</q-btn>
            <q-btn align="left" class="text-capitalize" color="grey-6" disable>Issue FG</q-btn>
          </q-card-actions>
        </q-card>
      </div>
    </div>

  </div>

  <!-- <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="my-card">
            <q-card-section>
                <div class="text-h6">Customer Garment</div>
                <div class="text-subtitle2"></div>
            </q-card-section>

            <q-separator />

            <q-card-actions vertical>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">PO Customer</q-btn>
            </q-card-actions>
        </q-card>
        <q-card class="my-card">
            <q-card-section>
                <div class="text-h6">NAYLIT - Taiwan</div>
                <div class="text-subtitle2"></div>
            </q-card-section>

            <q-separator />

            <q-card-actions vertical>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">Stock Raw Material</q-btn>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">Issue Stock Raw Material</q-btn>
            </q-card-actions>
        </q-card>
        <q-card class="my-card">
            <q-card-section>
                <div class="text-h6">NAYLIT - Thai</div>
                <div class="text-subtitle2"></div>
            </q-card-section>

            <q-separator />

            <q-card-actions vertical>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">Receive , Issue RM Material</q-btn>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">Stock RM Material</q-btn>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">WIP Production Outstanding</q-btn>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">Inspection Result</q-btn>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">Warehouse FG</q-btn>
                <q-btn align="left" class="text-capitalize" color="deep-orange-3">Issue FG</q-btn>

            </q-card-actions>
        </q-card>
    </div> -->
  <q-dialog v-model="dialogRMMove" persistent maximized transition-show="slide-up" transition-hide="slide-down">
    <q-card class="bg-white text-black">
      <q-bar>
        Movement Raw Material
        <q-space />
        <q-btn dense flat icon="close" v-close-popup>
          <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
        </q-btn>
      </q-bar>
      <RMMove />
    </q-card>
  </q-dialog>

  <q-dialog v-model="dialogRMStock" persistent maximized transition-show="slide-up" transition-hide="slide-down">
    <q-card class="bg-white text-black">
      <q-bar>
        Stock Raw Material
        <q-space />
        <q-btn dense flat icon="close" v-close-popup>
          <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
        </q-btn>
      </q-bar>
      <RMStock />
    </q-card>
  </q-dialog>

  <q-dialog v-model="dialogWIP" persistent maximized transition-show="slide-up" transition-hide="slide-down">
    <q-card class="bg-white text-black">
      <q-bar>
        WIP Production Outstanding
        <q-space />
        <q-btn dense flat icon="close" v-close-popup>
          <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
        </q-btn>
      </q-bar>
      <SOList />
    </q-card>
  </q-dialog>

  <q-dialog v-model="dialogQT" persistent maximized transition-show="slide-up" transition-hide="slide-down">
    <q-card class="bg-white text-black">
      <q-bar>
        Quality Test & Inspection Result
        <q-space />
        <q-btn dense flat icon="close" v-close-popup>
          <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
        </q-btn>
      </q-bar>
      <QTList />
    </q-card>
  </q-dialog>

  <q-dialog v-model="dialogFG" persistent maximized transition-show="slide-up" transition-hide="slide-down">
    <q-card class="bg-white text-black">
      <q-bar>
        Warehouse FG
        <q-space />
        <q-btn dense flat icon="close" v-close-popup>
          <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
        </q-btn>
      </q-bar>
      <FGThai />
    </q-card>
  </q-dialog>

  <q-dialog v-model="dialogPO" persistent maximized transition-show="slide-up" transition-hide="slide-down">
    <q-card class="bg-white text-black">
      <q-bar>
        PO Customer
        <q-space />
        <q-btn dense flat icon="close" v-close-popup>
          <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
        </q-btn>
      </q-bar>
      <POCus />
    </q-card>
  </q-dialog>

</div>
</template>

<script>
// @ is an alias to /src
import POCus from '@/components/POCus.vue'

import RMStock from '@/components/rmstock.vue'
import RMMove from '@/components/rmmove.vue'

import WIPSummary from '@/components/wipSummary.vue'
import SOList from '../components/SOlist'
import QTList from '../components/QTList'
import FGThai from '../components/fgthai'

export default {
  name: 'home',
  components: {
    RMStock,
    RMMove,
    WIPSummary,
    SOList,
    QTList,
    FGThai,
    POCus
  },
  data() {
    return {
      dialogRMStock: false,
      dialogRMMove: false,
      dialogWIP: false,
      dialogQT: false,
      dialogFG: false,
      dialogPO: false
    };
  }
}
</script>

<style scoped>
.my-card {
  width: 100%;
  max-width: 300px;
}
</style>
