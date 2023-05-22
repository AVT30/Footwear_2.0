@extends('layout.page')

@section('content')

<div class="container py-10">
    <style>@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);</style>


<div class="min-w-screen min-h-screen  flex items-center justify-center px-5 pb-10 pt-16">
    <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
        <div class="w-full pt-1 pb-5">
            <div class="bg-indigo-500 text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                <i class="mdi mdi-credit-card-outline text-3xl"></i>
            </div>
        </div>
        <div class="mb-10">
            <h1 class="text-center font-bold text-xl uppercase">Payement</h1>
        </div>
        <div class="mb-3 flex -mx-2">
            <div class="px-2">
                <label for="type1" class="flex items-center cursor-pointer">
                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type1" checked>
                    <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
                </label>
            </div>
        </div>
        <form action="{{ route('stripePost') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="font-bold text-sm mb-2 ml-1">Nom de Carte</label>
                <div>
                    <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="Entrez les valeurs par défault : John Smith" type="text" id="nomcarte" name="nomcarte" maxlength="50"/>
                </div>
            </div>
            <div class="mb-3">
                <label class="font-bold text-sm mb-2 ml-1">Numero de carte</label>
                <div>
                    <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="4242 4242 4242 4242" type="number" id="number" name="number" maxlength="16" required/>
                </div>
            </div>
            <div class="mb-3 -mx-2 flex items-end">
                <div class="px-2 w-1/2">
                    <label class="font-bold text-sm mb-2 ml-1">Expiration date</label>
                    <div>
                        <input type="number" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" id="exp_month" name="exp_month" placeholder="12 " maxlength="2" required>
                    </div>
                </div>
                <div class="px-2 w-1/2">
                    <input type="number" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" id="exp_year" name="exp_year" placeholder="2025" maxlength="4" required>
                </div>
            </div>
            <div class="mb-10">
                <label class="font-bold text-sm mb-2 ml-1">CVC</label>
                <div>
                    <input class="w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="123" type="number"  id="cvc" name="cvc" required/>
                </div>
            </div>
            <div class="mb-10">
                <div>
                    <input hidden type="text" class="form-control" id="totalapayer" name="totalapayer" {{$totalpanier}}>
                </div>
            </div>
            <div>
                <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> Payer {{$totalpanier}} CHF</button>
            </div>
        </form>
        @if (Session::has('stripe_error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Erreur!</strong>
                <span class="block sm:inline">{{ Session::get('stripe_error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L15.586 10l-2.293-2.293a1 1 0 010-1.414l3-3z"/></svg>
                </span>
            </div>
        @endif
    </div>
</div>

<style>
    /*
    module.exports = {
        plugins: [require('@tailwindcss/forms'),]
    };
    */
    .form-radio {
      -webkit-appearance: none;
         -moz-appearance: none;
              appearance: none;
      -webkit-print-color-adjust: exact;
              color-adjust: exact;
      display: inline-block;
      vertical-align: middle;
      background-origin: border-box;
      -webkit-user-select: none;
         -moz-user-select: none;
          -ms-user-select: none;
              user-select: none;
      flex-shrink: 0;
      border-radius: 100%;
      border-width: 2px;
    }

    .form-radio:checked {
      background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
      border-color: transparent;
      background-color: currentColor;
      background-size: 100% 100%;
      background-position: center;
      background-repeat: no-repeat;
    }

    @media not print {
      .form-radio::-ms-check {
        border-width: 1px;
        color: transparent;
        background: inherit;
        border-color: inherit;
        border-radius: inherit;
      }
    }

    .form-radio:focus {
      outline: none;
    }

    .form-select {

      -webkit-appearance: none;
         -moz-appearance: none;
              appearance: none;
      -webkit-print-color-adjust: exact;
              color-adjust: exact;
      background-repeat: no-repeat;
      padding-top: 0.5rem;
      padding-right: 2.5rem;
      padding-bottom: 0.5rem;
      padding-left: 0.75rem;
      font-size: 1rem;
      line-height: 1.5;
      background-position: right 0.5rem center;
      background-size: 1.5em 1.5em;
    }

    .form-select::-ms-expand {
      color: #a0aec0;
      border: none;
    }

    @media not print {
      .form-select::-ms-expand {
        display: none;
      }
    }

    @media print and (-ms-high-contrast: active), print and (-ms-high-contrast: none) {
      .form-select {
        padding-right: 0.75rem;
      }
    }
    </style>
</div>
<script src="https://js.stripe.com/v2/"></script>


@endsection
