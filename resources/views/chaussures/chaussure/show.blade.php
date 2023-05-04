@extends('layout.page')
<script>
    function highlightStar(starNumber) {
        // Highlight selected star
        for (let i = 1; i <= starNumber; i++) {
            document.getElementById('rating' + i).checked = true;
            document.querySelector(`label[for=rating${i}]`).classList.add('text-yellow-500');
        }

        // Un-highlight unselected stars
        for (let i = starNumber + 1; i <= 5; i++) {
            document.getElementById('rating' + i).checked = false;
            document.querySelector(`label[for=rating${i}]`).classList.remove('text-yellow-500');
        }
    }
</script>
@section('content')

    <div style='background-color:rgba(0, 0, 0, 0)'>
        <div class="container px-5 py-24 mx-auto" style="cursor: auto;">
          <div class="lg:w-4/5 mx-auto flex flex-wrap">
            @if($chaussure->image)
                <img alt="chaussure" class="lg:w-1/3 w-full lg:h-96  h-96  object-cover object-center rounded" src="{{ asset('storage/images/'.$chaussure->image->image_chaussure) }}" class="object-contain" alt="Image chaussure"  style="cursor: auto;">
            @endif
                <form action="{{ route('panier_add', ['id' => $chaussure->id_chaussure]) }}" method="post" id="panier_add">
                    @csrf
                    <div class="lg:w-1/1 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0" style="cursor: auto;">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest" style="cursor: auto;">ON SALE</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1" style="cursor: auto;">{{ $chaussure->modele }}</h1>
                    <h1 class="text-gray-900 py-2-" style="cursor: auto;">Chaussures pour {{ $chaussure->genre }}</h1>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1 py-4" style="cursor: auto;">{{ $chaussure->prix }} CHF</h1>
                    <div class="flex mb-4">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="ml-2 text-sm font-bold text-gray-900 dark:text-white">4.95</p>
                            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                            <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">73 reviews</a>
                        </div>
                    </div>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                        <div class="flex">
                        </div>
                        <div class="flex ml-6 items-center">
                        <span class="mr-3">Taille</span>
                        <div class="relative">
                            <select name="taille" id="taille" class="rounded border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base" required>
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
                            <select name="quantity" id="quantity" class="rounded border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base" required>
                                <option value="">Quantité</option>
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="flex">
                        <button type="submit" form="panier_add" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Ajouter au panier</button>
                    </div>
                </form>
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
                                                    <div class="max-w-xl mx-auto mt-16 flex w-full flex-col border rounded-lg bg-white p-8">
                                                        <h2 class="title-font mb-1 text-lg font-medium text-gray-900">Feedback</h2>
                                                        <p class="mb-5 leading-relaxed text-gray-600">If you had any issues or you liked our product, please share
                                                            with us!
                                                        </p>
                                                        <div class="mb-4">
                                                            <div class="flex items-center">
                                                                <label for="rating" class="mr-4">Note:</label>
                                                                <div class="flex">
                                                                  <!-- Utilisation d'un tableau pour générer les étoiles dynamiquement -->
                                                                  @foreach(range(1, 5) as $i)
                                                                    <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" class="hidden" />
                                                                    <label for="rating{{ $i }}" class="text-gray-600 hover:text-yellow-500 cursor-pointer">&#9733;</label>
                                                                  @endforeach
                                                                </div>
                                                              </div>

                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="message" class="text-sm leading-7 text-gray-600">Message</label>
                                                            <textarea id="message" name="message" class="h-32 w-full resize-none rounded border border-gray-300 bg-white py-1 px-3 text-base leading-6 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"></textarea>
                                                        </div>
                                                        <button class="rounded border-0 bg-indigo-500 py-2 px-6 text-lg text-white hover:bg-indigo-600 focus:outline-none">Send</button>
                                                        <p class="mt-3 text-xs text-gray-500">Feel free to connect with us on social media platforms.</p>
                                                    </div>
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


