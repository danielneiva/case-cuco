<template>
  <q-card
    class="q-pa-sm q-ma-xs full-width"
  >
    <q-btn
      class="float-right q-pa-xs"
      color="negative"
      icon="delete"
      round
      @click="deletarCliente(cliente.nome)"
    />
    <span class="text-h6 text-primary">{{cliente.nome}}</span><br>
    <span class="text-grey-8"><b>CPF: </b>{{cliente.cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")}}</span><br>
    <span class="text-grey-8"><b>Nascimento: </b>{{reuso.formataData(cliente.nascimento, 'DD/MM/YYYY')}}</span><br>
    <span class="text-grey-8"><b>Telefone: </b>{{cliente.telefone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3")}}</span><br>

  </q-card>
</template>
<script setup>
import { api } from '../helpers/axios'
import { reuso } from '../helpers/reuso'
import { useQuasar } from 'quasar'

const $q = useQuasar()


const { cliente, index } = defineProps(['cliente', 'index'])
const emit = defineEmits(['clienteDeletado'])

const deletarCliente = (nome) => {
  $q.dialog({
    title: 'Confirmar exclusão de cliente',
    message: `Tem certeza de que deseja excluir o cliente <strong style="color:red">${nome}</strong>?`,
    html:true,
    cancel: true,
  }).onOk(() => {
    reuso.showLoading()
    api.delete(`clientes/${cliente.id}`)
    .then((response) => {
      emit('clienteDeletado', cliente.id)
      reuso.hideLoading()
      reuso.mensagemSucesso('Cliente deletado com sucesso')
    })
    .catch((error) => {
      reuso.mensagemErro('Houve um erro ao deletar o cliente')
    })
  })
}
</script>