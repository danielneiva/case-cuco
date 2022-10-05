<template>
  <div class="q-pa-md row justify-center">
    <div class="col-12">
      <div class="row justify-center items-center">
        <div class="col-sm-12 col-md-4 q-py-md q-px-xs">
          <q-input
            label="Nome"
            outlined
            clearable
            v-model="filtro.nome"
          />
        </div>
        <div class="col-sm-12 col-md-4 q-py-md q-px-xs">
          <q-input
            label="CPF"
            outlined
            clearable
            mask="###.###.###-##"
            unmasked-value
            v-model="filtro.cpf"
          />
        </div>
        <div class="col-sm-12 col-md-4 q-py-md q-px-xs">
          <q-btn
            color="positive"
            icon="search"
            label="Filtrar"
            @click.prevent="buscarClientes"
          />
        </div>
      </div>
    </div>
    <div class="col-12 q-pb-md q-px-sm">
      <q-separator spaced size="2px" color="secondary"/>
    </div>
    <div 
      class="col-sm-12 col-md-4 col-lg-3"
      v-for="cliente in clientes"
      :key="cliente.id"
    >
      <ClienteCard :cliente="cliente" @cliente-deletado="onClienteDeletado"/>
    </div>
  </div>
</template>
<script setup>
import ClienteCard from './ClienteCard.vue';
import { onBeforeMount, ref } from 'vue'
import { api } from '../helpers/axios'
import { reuso } from '../helpers/reuso'
const clientes = ref([])
const filtro = ref({
  nome: null,
  cpf: null,
})

const getClientes = () => {
  reuso.showLoading()
  api.get('clientes')
  .then((response) => {
    clientes.value = response.data
    reuso.hideLoading()
  })
}

const onClienteDeletado = (id) => {
  let index = clientes.value.findIndex((cliente) => cliente.id == id)
  clientes.value.splice(index, 1)
}

const buscarClientes = () => {
  reuso.showLoading()
  api.post('clientes/buscar', filtro.value)
  .then((response) => {
    clientes.value = response.data
    reuso.mensagemSucesso('Clientes filtrados com sucesso')
    reuso.hideLoading()
  })
  .catch((error) => {
    reuso.mensagemErro('Houve um erro ao filtrar os clientes')
    reuso.hideLoading()
  })
}

onBeforeMount(() => {
  getClientes()
})
</script>