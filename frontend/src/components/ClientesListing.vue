<template>
  <div class="q-pa-md row justify-center">
    <div class="col-12">
      <div class="row justify-center items-center">
        <div class="col-xs-12 col-md-4 q-py-md q-px-xs">
          <q-input
            label="Nome"
            outlined
            clearable
            v-model="filtro.nome"
          />
        </div>
        <div class="col-xs-12 col-md-4 q-py-md q-px-xs">
          <q-input
            label="CPF"
            outlined
            clearable
            mask="###.###.###-##"
            unmasked-value
            v-model="filtro.cpf"
          />
        </div>
        <div class="col-xs-12 col-md-4 q-py-md q-px-xs text-right">
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
    <div class="col-12 row justify-center items-stretch">
      <div class="col-12 flex flex-center ">
        <q-pagination
          v-model="pagination.current"
          @update:model-value="buscarClientes()"
          :max="pagination.max"
          :max-pages="5"
          direction-links
          gutter="sm"
        />
      </div>
        <div 
          class="col-xs-12 col-sm-8 col-md-6 q-pa-md"
          v-for="cliente in clientes"
          :key="cliente.id"
        >
          <ClienteCard
            :cliente="cliente"
            @cliente-deletado="onClienteDeletado"
            class="full-width full-height" 
          />
        </div>
      <div class="col-12 flex flex-center ">
        <q-pagination
          v-model="pagination.current"
          @update:model-value="buscarClientes()"
          :max="pagination.max"
          :max-pages="5"
          direction-links
          gutter="sm"
        />
      </div>
    </div>
  </div>
</template>
<script setup>
import ClienteCard from './ClienteCard.vue';
import { onBeforeMount, ref, watch } from 'vue'
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
  api.post(`clientes/buscar?page=${pagination.value.current}&clientes_por_pagina=${pagination.value.per_page}`, filtro.value)
  .then((response) => {
    clientes.value = response.data.data
    pagination.value.max=response.data.last_page
    reuso.mensagemSucesso('Clientes encontrados com sucesso')
    reuso.hideLoading()
  })
  .catch((error) => {
    console.log(error)
    reuso.mensagemErro('Houve um erro ao buscar os clientes')
    reuso.hideLoading()
  })
}

const pagination = ref({
  current: 1,
  max: 5, 
  min: 1,
  per_page:10,
})

onBeforeMount(() => {
  getClientes()
})
</script>