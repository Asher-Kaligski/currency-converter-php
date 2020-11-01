jQuery(document).ready(function ($) {
  const CHOSEN_CURRENCIES = 'CHOSEN_CURRENCIES';

  const selectBaseCurrency = document.getElementById('base-currency');
  const selectCurrencies = document.getElementById('currencies');
  const value = document.getElementById('value');
  const chosenCountriesSelector = '.chosen-currencies';

  if (screen.width < 992) {
    $('table').addClass('table-responsive');
  }

  $(chosenCountriesSelector).empty();

  const chosenCurrencies = localStorage.getItem(CHOSEN_CURRENCIES);

  if (chosenCurrencies) {
    let countriesArr = chosenCurrencies.split(',');
    countriesArr.forEach((country) => {
      $(chosenCountriesSelector).append(
        '<li class="list-group-item">' +
          country +
          '<i class="fa fa-2x fa-trash float-right" aria-hidden="true"></i></li>'
      );
    });
  }

  $.get('https://api.exchangeratesapi.io/latest', function (data) {
    let countries = Object.keys(data.rates);
    let baseCurrencyCountries = [];
    let currenciesCountries = [];

    for (let i = 0; i < countries.length; i++) {
      if (i <= 9) {
        baseCurrencyCountries.push(countries[i]);
        currenciesCountries.push(countries[i]);
      }

      if (i > 9) break;
    }

    $('#base-currency').append('<option value="">Change from</option>');

    baseCurrencyCountries.forEach((country) => {
      $('#base-currency').append(
        '<option value="' + country + '">' + country + '</option>'
      );
    });

    $('#currencies').append('<option value="">Change to</option>');

    currenciesCountries.forEach((country) => {
      $('#currencies').append(
        '<option value="' + country + '">' + country + '</option>'
      );
    });
  });

  document
    .querySelector('.add-currency')
    .addEventListener('click', function (e) {
      e.preventDefault();

      const selectedCountryToAdd = selectCurrencies.value;

      if (selectedCountryToAdd === '') return alert("Change To can't be empty");

      let chosenCurrencies = localStorage.getItem(CHOSEN_CURRENCIES);

      if (!chosenCurrencies) {
        localStorage.setItem(CHOSEN_CURRENCIES, selectedCountryToAdd);

        $(chosenCountriesSelector).append(
          '<li class="list-group-item">' +
            selectedCountryToAdd +
            '<i class="fa fa-2x fa-trash float-right" aria-hidden="true"></i></li>'
        );
      } else if (
        chosenCurrencies &&
        !chosenCurrencies.includes(selectedCountryToAdd)
      ) {
        const currenciesArr = chosenCurrencies.split(',');
        if (currenciesArr.length > 9)
          return alert("You can't add more than 10 currencies");

        chosenCurrencies += ',' + selectedCountryToAdd;
        localStorage.setItem(CHOSEN_CURRENCIES, chosenCurrencies);

        $(chosenCountriesSelector).append(
          '<li class="list-group-item">' +
            selectedCountryToAdd +
            '<i class="fa fa-2x fa-trash float-right" aria-hidden="true"></i></li>'
        );
      } else {
        return alert('The currency already added');
      }
    });

  $(document).on('click', '.fa-trash', function (e) {
    const currency = e.currentTarget.offsetParent.innerText;

    $('li:contains(' + currency + ')').remove();

    let chosenCurrencies = localStorage.getItem(CHOSEN_CURRENCIES);

    if (!chosenCurrencies.includes(','))
      localStorage.removeItem(CHOSEN_CURRENCIES);
    else {
      const currenciesArr = chosenCurrencies.split(',');

      const index = currenciesArr.findIndex((c) => c === currency);

      if (index !== -1) currenciesArr.splice(index, 1);

      let currencies = '';
      currenciesArr.forEach((c, index) => {
        if (index === currenciesArr.length - 1) currencies += c;
        else currencies += c + ',';
      });

      localStorage.setItem(CHOSEN_CURRENCIES, currencies);
    }
  });

  document
    .querySelector('.show-change')
    .addEventListener('click', function (e) {
      e.preventDefault();

      const number = value.value;
      const baseCurrency = selectBaseCurrency.value;
      const chosenCurrencies = localStorage.getItem(CHOSEN_CURRENCIES);

      let errors = [];
      if (number === '') errors.push('Change Value');
      if (baseCurrency === '') errors.push('Change From');
      if (!chosenCurrencies) errors.push('Change To');

      if (errors.length) {
        let str = '';
        errors.forEach((e, index) => {
          if (index === errors.length - 1) str += e;
          else str += e + ',';
        });
        return alert(str + " can't be empty");
      }

      $.ajax({
        url: 'get_rates.php',
        type: 'GET',
        data: { baseCurrency: baseCurrency },
        dataType: 'JSON',
        success: function (response) {
          $('.table-body').empty();

          let rates = JSON.parse(response.rates);
          let ratesArr = [];

          for (const key in rates) {
            if (chosenCurrencies.includes(key)) {
              ratesArr.push({
                currency: key,
                changeRate: rates[key],
                value: (rates[key] * number).toFixed(4),
              });
            }
          }

          ratesArr.forEach((rate) => {
            $('.table-body').append(`<tr> 
               <td>${rate.value}</td>
               <td>${rate.changeRate}</td>
               <td class="text-center">${rate.currency}</td>
               <td class="text-center">${baseCurrency}</td>
               </tr>`);
          });
        },
      });
    });
});
