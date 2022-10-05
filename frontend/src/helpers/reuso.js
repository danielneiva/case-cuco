import { Notify, Loading, date } from "quasar";

const reuso = {
  mensagemErro(msg, error = "", duracao=10000) {
    let objErros = "";
    let msgErro = "";
    if (error.response){
      if (error.response.status !== 422) {
        msgErro = `<br/> ${error.response?.data?.message} <br/> Caso persista entre em contato conosco (contato@kienbaumdigital.com.br). <br/> Status ${error.response?.status} ${error.response?.statusText}`;
      } else if (error.response.status === 422) {
        objErros = error.response.data.errors;
        for (var prop in objErros) {
          msgErro = `${msgErro} <br/> ${objErros[prop]}`;
        }
      }
    } else if (error.request){
      msgErro = `<br/> ${error.request} <br/> Caso persista entre em contato conosco (contato@kienbaumdigital.com.br).`;
    }
    Notify.create({
      message: `${msg} ${msgErro}`,
      color: "negative",
      textColor: "white",
      position: "bottom",
      icon: "report_problem",
      timeout: duracao,
      html: true,
    });
  },
  mensagemSucesso(msg, duracao=10000) {
    Notify.create({
      message: msg,
      color: "green-4",
      textColor: "white",
      position: "bottom",
      icon: "cloud_done",
      timeout: 10000,
      html: true,
    });
  },
  showLoading: function () {
    return Loading.show();
  },
  hideLoading: function () {
    return Loading.hide();
  },
  validarCPF(cpf){
    if (!cpf) return true
    let primeiroDigito = 0, segundoDigito = 0;
    for (var i=0; i < 9; i++){
      primeiroDigito += cpf[i] * (i+1) 
    }
    primeiroDigito = primeiroDigito % 11
    if (primeiroDigito != cpf[9]) return false
    for (var i=0; i< 10; i ++){
      segundoDigito += cpf[i] * i
    }
    segundoDigito = segundoDigito % 11
    if (segundoDigito != cpf[10]) return false
    return true
  },
  formataData(dataHora, format) {
    let dataTimestamp = +new Date(dataHora);
    return date.formatDate(dataTimestamp, format);
  },
}

export { reuso }