@extends('layout.page')
<style>
    select:checked ~ #rating-selected #rating-fill {
      width: calc(var(--rating) / 5 * 100%);
    }
  </style>
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
                                                        Postez votre avis concernant cet article
                                                    </span>
                                                    <span class="ico-plus"></span>
                                                </div>
                                            </button>
                                            <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                                <div class="px-10">
                                                    <div class="max-w-xl mx-auto mt-16 flex w-full flex-col border rounded-lg bg-white p-8">
                                                        <form action="{{ route('avis', ['id' => $chaussure->id]) }}" method="POST">
                                                            @csrf
                                                            <h2 class="title-font mb-1 text-lg font-medium text-gray-900">Feedback</h2>
                                                            <p class="mb-5 leading-relaxed text-gray-600">Nous voulons votre avis !!! Faites nous savoir ce que vous pensez de cet article</p>
                                                            <div class="mb-4">
                                                                <div class="flex items-center">
                                                                    <label for="rating" class="mr-4">Note:</label>
                                                                    <div class="flex">
                                                                    <!-- Utilisation d'un tableau pour générer les étoiles dynamiquement -->
                                                                    <div class="rating">
                                                                        <span class="star" data-value="1" name="rating"></span>
                                                                        <span class="star" data-value="2" name="rating"></span>
                                                                        <span class="star" data-value="3" name="rating"></span>
                                                                        <span class="star" data-value="4" name="rating"></span>
                                                                        <span class="star" data-value="5" name="rating"></span>
                                                                    </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="message" class="text-sm leading-7 text-gray-600">Message</label>
                                                                <textarea id="message" name="message" class="h-32 w-full resize-none rounded border border-gray-300 bg-white py-1 px-3 text-base leading-6 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"></textarea>
                                                            </div>
                                                            <button class="rounded border-0 bg-indigo-500 py-2 px-6 text-lg text-white hover:bg-indigo-600 focus:outline-none">Poster</button>
                                                            <p class="mt-3 text-xs text-gray-500">N'hesitez pas à nous contacter sur nos réseaux.</p>
                                                        </form>
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
    <style>
        .rating {
          display: inline-block;
          font-size: 0;
        }

        .star {
          display: inline-block;
          width: 20px;
          height: 20px;
          margin: 0 2px;
          background-color: #ccc;
          border-radius: 50%;
          cursor: pointer;
        }

        .star:hover,
        .star.active {
          background-color: #ffc107;
        }
      </style>
    <script>
            // Sélectionner toutes les étoiles
            const stars = document.querySelectorAll('.star');

            // Initialiser la note à 0
            let rating = 0;

            // Ajouter un événement "click" pour chaque étoile
            stars.forEach((star) => {
                star.addEventListener('click', () => {
                    // Mettre à jour la note en fonction de la valeur "data-value" de l'étoile cliquée
                    rating = star.getAttribute('data-value');
                    // Mettre à jour l'affichage de la note
                    updateRating();
                });

                // Ajouter un événement "mouseover" pour chaque étoile
                star.addEventListener('mouseover', () => {
                    // Réinitialiser toutes les étoiles à leur état inactif
                    resetRating();
                    // Ajouter la classe "active" à l'étoile survolée
                    star.classList.add('active');
                    // Ajouter la classe "active" à toutes les étoiles précédentes
                    const prevStars = Array.from(star.parentNode.children).slice(0, star.getAttribute('data-value') - 1);
                    prevStars.forEach((prevStar) => {
                        prevStar.classList.add('active');
                    });
                });

                // Ajouter un événement "mouseout" pour chaque étoile
                star.addEventListener('mouseout', () => {
                    // Réinitialiser toutes les étoiles à leur état inactif
                    resetRating();
                    // Si une note a été sélectionnée, ajouter la classe "active" aux étoiles sélectionnées
                    if (rating > 0) {
                        const selectedStars = Array.from(star.parentNode.children).slice(0, rating);
                        selectedStars.forEach((selectedStar) => {
                            selectedStar.classList.add('active');
                        });
                    }
                });
            });

            // Fonction pour réinitialiser toutes les étoiles à leur état inactif
            function resetRating() {
                stars.forEach((star) => {
                    star.classList.remove('active');
                });
            }

            // Fonction pour mettre à jour la note
            function updateRating() {
                // Enregistrer la note dans une base de données, envoyer un formulaire, etc.
                console.log(`Note : ${rating}/5`);
            }

    </script>


@endsection


