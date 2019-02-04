/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pagseguro.js":
/***/ (function(module, exports) {

var errors = {
  'bad_request': 'O pagamento não pode ser processado',
  '5003': 'falha de comunicação com a instituição financeira',
  '10000': 'bandeira inválida',
  '10001': "número do cartão inválido",
  '10002': "data no formato inválido",
  '10003': "código de segurança inválido",
  '10004': "cvv obrigatório",
  '10006': "código de segurança inválido",
  '53004': "quantidade de ítens inválido",
  '53005': "moeda obrigatória",
  '53006': "moeda inválida",
  '53007': "tamanho do campo referência inválido",
  '53008': "url de notificação inválida",
  '53009': "tamanho da url de notificação inválida",
  '53010': "email do comprador inválido.",
  '53011': "email do comprador inválido",
  '53012': "tamanho do campo email do comprador inválido",
  '53013': "nome do comprador obrigatório",
  '53014': "nome do comprador inválido",
  '53015': "tamanho do campo nome do comprador inválido",
  '53017': "cpf do comprador inválido",
  '53018': "código de área do telefone inválido",
  '53019': "tamanho do campo código de área do telefone inválido",
  '53020': "telefone obrigatório",
  '53021': "telefone inválido",
  '53022': "CEP obrigatório",
  '53023': "CEP inválido",
  '53024': "rua do endereço obrigatório",
  '53025': "rua do endereço inválido",
  '53026': "número do endereço obrigatório",
  '53027': "número do endereço inválido",
  '53028': "complemento do endereço inválido",
  '53029': "bairro do endereço obrigatório",
  '53030': "bairro do endereço inválido",
  '53031': "cidade do endereço obrigatória",
  '53032': "cidade do endereço inválida",
  '53033': "estado do endereço obrigatório",
  '53034': "estado do endereço inválido",
  '53035': "país do endereço obrigatório.",
  '53036': "país do endereço inválido",
  '53037': "token do cartão de crédito obrigatório",
  '53038': "quantidade de parcelas obrigatória",
  '53039': "quantidade de parcelas inválida",
  '53040': "valor da parcela obrigatória",
  '53041': "valor da parcela inválida",
  '53042': "portador do cartão obrigatório",
  '53043': "portador do cartão inválido",
  '53044': "tamanho do campo portador do cartão inválido",
  '53045': "CPF do portador do cartão obrigatório",
  '53046': "CPF do portador do cartão inválido",
  '53047': "data de nascimento do portador do cartão obrigatório",
  '53048': "data de nascimento do portador do cartão inválido",
  '53049': "código de área do portador do cartão obrigatório",
  '53050': "código de área do portador do cartão inválido",
  '53051': "telefone do portador do cartão obrigatório",
  '53052': "telefone  do portador do cartão inválido",
  '53053': "CEP do portador do cartão obrigatório",
  '53054': "CEP do portador do cartão inválido",
  '53055': "rua do portador do cartão obrigatório",
  '53056': "rua do portador do cartão inválido",
  '53057': "número do endereço do portador do cartão obrigatório",
  '53058': "número do endereço do portador do cartão inválido",
  '53059': "tamanho do campo complemento do endereço do portador do cartão inválido",
  '53060': "bairro do portador do cartão obrigatório",
  '53061': "tamanho do campo bairro do portador do cartão inválido",
  '53062': "cidade do portador do cartão obrigatório",
  '53063': "tamanho do campo cidade do portador do cartão inválido",
  '53064': "estado do portador do cartão obrigatório",
  '53065': "estado do portador do cartão inválido",
  '53066': "país do portador do cartão obrigatório",
  '53067': "tamanho do campo país do portador do cartão inválido",
  '53068': "tamanho do email do vendedor inválido",
  '53069': "email do vendedor inválido",
  '53070': "código do ítem obrigatório",
  '53071': "tamanho do código do ítem inválido",
  '53072': "descrição do ítem obrigatório",
  '53073': "tamanho do campo ítem inválido",
  '53074': "quantidade de ítens obrigatória",
  '53075': "quantidade de ítens fora do limite",
  '53076': "quantidade de ítens inválido",
  '53077': "montante do ítem obrigatório",
  '53078': "montante do ítem inválido.",
  '53079': "montante fora do limite",
  '53081': "comprador é igual ao vendedor",
  '53084': "vendedor inválido, verifique se é uma conta com status de vendedor",
  '53085': "método de pagamento indisponível",
  '53086': "montante total acima do limite do cartão",
  '53087': "dados do cartão inválidos",
  '53091': "hash do comprador inválido",
  '53092': "bandeira do cartão não aceita",
  '53095': "tipo de entrega inválido",
  '53096': "custo de entrega inválido",
  '53097': "custo da entrega fora do limite",
  '53098': "valor total é negatívo",
  '53099': "montante extra inválido.",
  '53101': "modo de pagamento inválido, valores válidos são default e gateway",
  '53102': "método de pagamento inválido, valores válidos são creditCard, boleto e eft",
  '53104': "custo de entrega informado, endereço de entrega deve ser completo",
  '53105': "informações do comprador informado, email também deve ser informado",
  '53106': "portador do cartão incompleto",
  '53109': "endereço do comprador informado, email do comprador também deve ser informado",
  '53110': "banco eft obrigatório",
  '53111': "banco eft não aceito",
  '53115': "data de nascimento do comprador inválida",
  '53117': "CPNJ do comprador inválido",
  '53122': "domínio do email do comprador inválido. Você deve usar um email @sandbox.pagseguro.com.br",
  '53140': "quantidade de parcelas fora do limite. O valor deve ser maior que zero",
  '53141': "comprador bloqueado",
  '53142': "token do cartão de crédito inválido",
  '14007': "status da transação não permite reembolso"
};

getCardFlag = function getCardFlag(input, cardNumber, form) {
  showValidationMessage(form, 'validating');

  PagSeguroDirectPayment.getBrand({
    cardBin: cardNumber,
    success: function success(response) {
      var icon = response.brand.name;
      input.css('background-image', 'url(https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/' + icon + '.png)');
      form.find('input[name="card_brand"]').val(icon);
      showValidationMessage(form, 'valid');
    },
    error: function error() {
      input.css('background-image', 'url(http://metropolis.test/images/icons/credit.png)');
      form.find('input[name="card_brand"]').val('');
      showValidationMessage(form, 'invalid');
    },
    complete: function complete(response) {
      console.log(response);
    }
  });
};

function showValidationMessage(form, status) {
  form.find('.card-validation').hide();
  form.find('#card-' + status).show();
}

function showError(response) {
  return ucfirst(errors[Object.keys(response.errors)[0]]);
}

function ucfirst(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

createMasks = function createMasks() {
  $('input.cpf-field').inputmask("999.999.999-99");
  $('input.cnpj-field').inputmask("99.999.999/9999-99");
  $('input[name="card_number"]').inputmask("9999 9999 9999 9999");
  $('input[name="cvv"]').inputmask("999[9]");
  $('input[name="address_zip"]').inputmask("99.999-999");
};

$(document).ready(function () {
  createMasks();

  PagSeguroDirectPayment.setSessionId(pagseguro.id);

  PagSeguroDirectPayment.getPaymentMethods({
    amount: 500.00,
    success: function success(data) {
      console.log(data);

      $('#form-credit .cards, #form-debit .cards').html('');

      $.each(data.paymentMethods.CREDIT_CARD.options, function (i, obj) {
        $('#form-credit .cards').append('<div class="m-1"><img src="https://stc.pagseguro.uol.com.br/' + obj.images.MEDIUM.path + '"></div>');
      });

      $.each(data.paymentMethods.ONLINE_DEBIT.options, function (i, obj) {
        $('#form-debit .cards').append('<div class="m-1"><img src="https://stc.pagseguro.uol.com.br/' + obj.images.MEDIUM.path + '"></div>');
      });
    },
    error: function error(data) {
      console.log('NO...');
    },
    complete: function complete(data) {
      console.log(data);
    }
  });
});

$(document).on('blur', 'input[name="card_number"]', function () {
  var input = $(this);
  var cardNumber = input.cleanVal();
  var $form = $($('button#submit').attr('data-target'));

  if (cardNumber.length >= 6) {
    getCardFlag(input, cardNumber, $form);
  }
});

$(document).on('keyup', 'input[name="card_number"]', function () {
  var input = $(this);
  var cardNumber = input.cleanVal();
  var $form = $($('button#submit').attr('data-target'));

  if (cardNumber.length == 6) {
    getCardFlag(input, cardNumber, $form);
  } else if (cardNumber.length < 6) {
    input.css('background-image', 'url(http://metropolis.test/images/icons/credit.png)');
    $form.find('input[name="card_brand"]').val('');
    $form.find('#card-invalid').hide();
  }
});

$(document).on('click', 'button#submit', function (event) {
  var $button = $(this);
  var $form = $($button.attr('data-target'));
  var buttonOriginalText = $button.text();

  if (!$form.find('input[name="card_number"]').val()) {
    alert('Por favor preencha o número do cartão corretamente');
    return;
  }

  $button.prop('disabled', true);
  $button.text('PROCESSANDO O SEU PEDIDO...');

  PagSeguroDirectPayment.createCardToken({
    cardNumber: $form.find('input[name="card_number"]').cleanVal(),
    brand: $form.find('input[name="card_brand"]').val(),
    cvv: $form.find('input[name="cvv"]').val(),
    expirationMonth: $form.find('select[name="expiry_month"] option:selected').val(),
    expirationYear: $form.find('select[name="expiry_year"] option:selected').val(),
    success: function success(response) {
      var cardLastfour = $form.find('input[name="card_number"]').val().substr($form.find('input[name="card_number"]').val().length - 4);
      $form.find('input[name="card_token"]').val(response.card.token);
      $form.find('input[name="card_lastfour"]').val(cardLastfour);

      PagSeguroDirectPayment.onSenderHashReady(function (response) {
        if (response.status == 'error') {
          console.log(response.message);
          return false;
        }

        $form.find('input[name="card_hash"]').val(response.senderHash);

        $form.submit();
      });
    },
    error: function error(response) {
      alert(showError(response));
      console.log(response);
      $button.prop('disabled', false);
      $button.text(buttonOriginalText);
    }
  });
});

$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
  $('button#submit').attr('data-target', $(e.target).attr('data-form'));
});

$(document).on('blur', 'input[name="address_zip"]', function () {
  var zip = $(this).val().replace(/\D/g, '');

  if (zip != "") {

    var validateZip = /^[0-9]{8}$/;

    if (validateZip.test(zip)) {

      $('input[name="address_street"]').val("...");
      $('input[name="address_district"]').val("...");
      $('input[name="address_state"]').val("...");
      $('input[name="address_city"]').val("...");

      //Consulta o webservice viacep.com.br/
      $.getJSON("https://viacep.com.br/ws/" + zip + "/json/?callback=?", function (data) {

        if (!("erro" in data)) {
          $('input[name="address_street"]').val(data.logradouro);
          $('input[name="address_district"]').val(data.bairro);
          $('input[name="address_state"]').val(data.uf);
          $('input[name="address_city"]').val(data.localidade);

          $('.zip-alert').hide();
          $('#zip-valid > div').text('CEP válido!').parent().show();
        } else {
          $('.address-fields input').val('');
          $('.zip-alert').hide();
          $('#zip-invalid > div').text('CEP não encontrado').parent().show();
        }
      });
    } else {
      $('.address-fields input').val('');
      $('.zip-alert').hide();
      $('#zip-invalid > div').text('Formato de CEP inválido').parent().show();
    }
  } else {
    $('.address-fields input').val('');
    $('.zip-alert').hide();
  }
});

$('input[name="select-card"]').on('change', function () {
  var $input = $(this);
  var url = $input.attr('data-url');
  var target = $input.parent().attr('data-target');

  $('.loading-icons').children().hide();
  $input.parent().siblings('.loading-icons').children('.text-grey').show();

  $.get(url, function (data) {
    $('#card-preference .collapse').html('');
    $(target).html(data);

    if ($input.attr('id') == 'existing-card-radio') {
      var $cardNumberInput = $('input[name="card_number"]');
      var $form = $($('button#submit').attr('data-target'));

      getCardFlag($cardNumberInput, $cardNumberInput.cleanVal(), $form);
    } else if ($input.attr('id') == 'new-card-radio') {
      createMasks();
    }

    $input.parent().siblings('.loading-icons').children('.text-grey').hide();
    $input.parent().siblings('.loading-icons').children('.text-green').show();
  });
});

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/js/pagseguro.js");


/***/ })

/******/ });