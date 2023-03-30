@extends('layout.page')

@section('content')
    <div style='background-color:rgba(0, 0, 0, 0)'>
        <div class="container px-5 py-24 mx-auto" style="cursor: auto;">
          <div class="lg:w-4/5 mx-auto flex flex-wrap">
            @if($chaussure->image)
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-128  h-128  object-cover object-center rounded" src="{{ asset('storage/images/'.$chaussure->image->image_chaussure) }}" class="object-contain" alt="Image chaussure"  style="cursor: auto;">
            @endif
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0" style="cursor: auto;">
              <h2 class="text-sm title-font text-gray-500 tracking-widest" style="cursor: auto;">ON SALE</h2>
              <h1 class="text-gray-900 text-3xl title-font font-medium mb-1" style="cursor: auto;">{{ $chaussure->modele }}</h1>
              <h1 class="text-gray-900 py-2-" style="cursor: auto;">Chaussures pour {{ $chaussure->genre }}</h1>
              <h1 class="text-gray-900 text-3xl title-font font-medium mb-1 py-4" style="cursor: auto;">{{ $chaussure->prix }} CHF</h1>
              <div class="flex mb-4">
                <span class="flex items-center">
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <span class="text-gray-600 ml-3">20 Reviews</span>
                </span>
              </div>
              <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                <div class="flex">
                </div>
                <div class="flex ml-6 items-center">
                  <span class="mr-3">Size</span>
                  <div class="relative">
                    <select class="rounded border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base">
                        <option value="">Taille Chaussure</option>
                        <?php for ($i = 30; $i <= 52; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6"></path>
                      </svg>
                    </span>
                  </div>
                </div>
              </div>
              <div class="flex">
                <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Buy</button>
                <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                  </svg>
                </button>
              </div>
                <div class="col-span-1 hidden lg:block">
                    <div class="full-grid h-screen">
                        <div class="ml-8">
                            <div class=" max-w-xl mx-auto 0">
                                <ul class="shadow-box">
                                    <li class="relative border-b border-gray-800" x-data="{selected:null}">
                                        <button type="button" class="w-full px-8 py-3 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                                            <div class="flex items-center justify-between">
                                                <span class="hover:underline font-bold">
                                                    Nous voulons votre avis !
                                                </span>
                                                <span class="ico-plus"></span>
                                            </div>
                                        </button>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                            <div class="px-10">
                                                <h1>dasda</h1>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="relative border-b border-gray-800" x-data="{selected:null}">
                                        <button type="button" class="w-full px-8 py-3 text-left" @click="selected !== 2 ? selected = 2 : selected = null">
                                            <div class="flex items-center justify-between">
                                                <span class="hover:underline font-bold">
                                                    Avis
                                                </span>
                                                <span class="ico-plus"></span>
                                            </div>
                                        </button>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container2" x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                                            <div class="px-10">
                                                <h1>dasda</h1>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
          </div>
        </div>
    </div>


@endsection


