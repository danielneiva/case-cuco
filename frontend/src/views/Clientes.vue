<template>
  <div class="window-height full-width bg-grey-2">
    <div class="row justify-center">
      <div class="col-12 text-center q-pa-md">
        <q-img
          src="../assets/logo-blue.png"
          fit
          width="280px"
        />
      </div>
      <div class="col col-xs-12 col-md-10 col-lg-8">
        <q-card>
          <q-tabs
            v-model="tab"
            dense
            class="text-grey"
            active-color="primary"
            indicator-color="primary"
            align="justify"
            narrow-indicator
          >
            <q-tab name="ver" label="Ver Clientes" />
            <q-tab name="cadastrar" label="Cadastrar Clientes" />
          </q-tabs>

          <q-separator />

          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="ver">
              <ClientesListing/>
            </q-tab-panel>

            <q-tab-panel name="cadastrar">
              <ClientesFormCadastro @cliente-cadastrado="tab='ver'"/>
            </q-tab-panel>
          </q-tab-panels>
        </q-card>
      
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onBeforeMount } from 'vue'
import ClientesListing from '../components/ClientesListing.vue';
import ClientesFormCadastro from '../components/ClientesFormCadastro.vue';

const tab = ref('ver')
</script>