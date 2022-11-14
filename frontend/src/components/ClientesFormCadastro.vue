<template>
  <q-form @submit="cadastrarCliente">
    <div class="q-pa-sm">
      <q-input
        label="Nome"
        outlined
        v-model="form.nome"
        :rules="[
          val => !!val || 'Este campo é obrigatório',
          val => val.length <= 255 || 'Este campo suporta até 255 caracteres',
          val => /^[a-zA-Z\s]+$/.test(val) || 'Este campo suporta apenas letras'
        ]"
        lazy-rules
      />
    </div>
    <div class="q-pa-sm">
      <q-input
        label="CPF"
        outlined
        v-model="form.cpf"
        :rules="[
          val => !!val || 'Este campo é obrigatório',
          val => reuso.validarCPF(val) || 'Este CPF não é válido',
        ]"
        lazy-rules
        mask="###.###.###-##"
        fill-mask
        unmasked-value
      />
    </div>
    <div class="q-pa-sm">
      <q-input
        label="Nascimento"
        stack-label
        outlined
        v-model="form.nascimento"
        type="date"
        :rules="[
          val => !!val || 'Este campo é obrigatório',
          val => new Date(val) < new Date() || 'Insira uma data válida'
        ]"
        lazy-rules
      />
    </div>
    <div class="q-pa-sm">
      <q-input
        label="Telefone"
        outlined
        v-model="form.telefone"
        :rules="[
          val => !!val || 'Este campo é obrigatório',
          val => val.length == 11 || 'Informe um telefone válido'
        ]"
        lazy-rules
        mask="(##)#####-####"
        fill-mask
        unmasked-value
      />
    </div>
    <div class="text-center">
      <q-btn
        color="positive"
        label="Cadastrar Cliente"
        type="submit"
      />
    </div>
  </q-form>

</template>
<script setup>
import { ref } from 'vue'
import { reuso } from '../helpers/reuso'
import { api } from '../helpers/axios'
const emit = defineEmits(['clienteCadastrado'])

const form = ref({
  nome: null,
  cpf: null,
  nascimento: null,
  telefone: null,
})

const cadastrarCliente = () => {
  reuso.showLoading()
  api.post('clientes', form.value)
  .then((response) => {
    reuso.mensagemSucesso('Cliente cadastrado com sucesso')
    reuso.hideLoading()
    emit('clienteCadastrado')
  })
}
</script>