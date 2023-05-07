@extends('layout.page')
@section('content')

    <div style='background-color:rgba(0, 0, 0, 0)'>
        <div class="container px-5 py-24 mx-auto" style="cursor: auto;">
          <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <div class="w-full h-auto bg-gray-400 lg:w-5/12 bg-cover rounded-l-lg flex lg:block">
                @if($chaussure->image)
                    <img src="{{ asset('storage/images/'.$chaussure->image->image_chaussure) }}" class="object-cover w-full h-full" alt="Image chaussure">
                @endif
            </div>



                <div class="w-full lg:w-1/2">
                <form action="{{ route('panier_add', ['id' => $chaussure->id_chaussure]) }}" method="post" id="panier_add">
                    @csrf
                    <div class="lg:w-5/5 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0" style="cursor: auto;">
                        @if($pourcentage)
                            <div class="bg-red-500 text-white text-center py-1">
                                <p>Offre spéciale !</p>
                                <p>Profitez de la réduction sur la chaussure</p>
                            </div>
                        @endif
                    <h2 class="text-sm title-font text-gray-500 tracking-widest" style="cursor: auto;">ON SALE</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1" style="cursor: auto;">{{ $chaussure->modele }}</h1>
                    <h1 class="text-gray-900 py-2-" style="cursor: auto;">Chaussures pour {{ $chaussure->genre }}</h1>
                    @if($pourcentage)
                        <h1 class="py-2- text-red-600" style="cursor: auto;">{{ $pourcentage }}% de réduction</h1>
                    @endif
                    @if($pourcentage != null)
                            {{-- deux inputs cachés dans le but de récupèrer ces deux valeurs pour les utilisers dans la card panier apres  --}}
                        <input type="hidden" name="pourcentage" value="{{ $pourcentage }}">
                        <input type="hidden" name="prixrabais" value="{{ $prix }}">
                        <h1 class=" text-3xl title-font font-medium mb-1  text-red-600" style="cursor: auto;">
                            {{ $prix }} CHF
                            <span class="line-through text-gray-500 ">{{ $chaussure->prix }} CHF</span>
                        </h1>
                    @else
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1 py-4" style="cursor: auto;">
                            {{ $chaussure->prix }} CHF
                        </h1>
                    @endif
                    <div class="flex mb-4">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="ml-2 text-sm font-bold text-gray-900 dark:text-white">{{ round($moyenneEtoiles, 2) }}</p>
                            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>

                            <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white" onclick="openPopup()">{{$totalAvis}} Avis</a>

                            <!-- Contenu du pop-up -->
                            <div id="popup" class="fixed z-50 inset-0 overflow-y-auto py-8 hidden">
                                <div class="flex items-center justify-center min-h-screen px-4">
                                  <div class="bg-white w-full max-w-screen-lg mx-auto rounded-lg shadow-lg">
                                    <div class="p-4">
                                      <div class="flex justify-end">
                                        <button class="text-gray-500 hover:text-gray-800 focus:outline-none" onclick="closePopup()">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                          </svg>
                                        </button>
                                      </div>
                                      <h2 class="text-lg font-medium mb-4">Avis</h2>
                                      <div class="overflow-y-scroll max-h-80">
                                        <!--Background-->
                                        @if(count($avis) > 0)
                                            @foreach($avis as $avisItem)
                                            <section class="relative flex min-w-screen border-b-slate-600">
                                            <div class="container px-0 mx-auto sm:px-5 py-2 border-b-slate-600">
                                                <div class=" py-4 mx-auto bg-white border-b-slate-600 border-b-2  sm:px-4 sm:py-4 md:px-4  sm:shadow-sm md:w-3/3">
                                                <div class="flex flex-col w-full">
                                                    <div class="flex flex-row w-full justify-between items-center">
                                                    <div class="flex flex-col mt-1">
                                                        <div class="flex items-center flex-1 px-4 font-bold leading-tight text-gray-700">{{$avisItem->user->nom . ' ' . $avisItem->user->prenom }}</div>
                                                        <div class="flex items-center flex-1 px-4 font-normal text-xs text-gray-500">{{$avisItem->created_at->format('d/m/Y H:i')}}</div>
                                                    </div>
                                                    </div>
                                                    <div class="flex-1 px-2 ml-2 text-sm font-medium leading-loose text-gray-600">{{$avisItem->commentaire}}</div>
                                                    {{-- ici un petit for pour afficher les étoiles en fonction du chiffre dans la variable etoile qui est dans le if/ remplir les étoiles en fonction du nombre d'étoile --}}
                                                    <div class="flex items-center mt-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $avisItem->etoile)
                                                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <title>Note donné</title>
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                </svg>
                                                            @else
                                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <title>Note donné</title>
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                </svg>
                                                            @endif
                                                        @endfor
                                                        <div class="flex-1 px-2 ml-2 text-sm font-medium leading-loose text-gray-600">{{$avisItem->etoile}}</div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </section>
                                            @endforeach
                                        @else
                                            <p class="">Aucun commentaire n'a encore été fait pour cette chaussure.</p>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
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
                </div>
                    <div class="col-span-1 hidden lg:block">
                        <div class="full-grid h-96">
                            <div class="ml-8">
                                <div class=" max-w-xl mx-auto 0">
                                    <ul class="shadow-box">
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
                <div class="lg:w-1/1 mx-auto flex flex-wrap w-full">
                    @if(Auth::check())
                        <form action="{{ route('avisuser', ['id' => $chaussure->id_chaussure]) }}"  method="get">
                            @csrf
                            <div class="w-full mx-auto w-full mt-16 border rounded-lg bg-white p-8">
                                <div class="w-full flex flex-col">
                                    <h2 class="title-font mb-1 text-lg font-medium text-gray-900">Feedback</h2>
                                    <p class="mb-5 leading-relaxed text-gray-600">Nous voulons votre avis !!! Faites nous savoir ce que vous pensez de cet article</p>
                                    <div class="mb-4">
                                        <div class="flex items-center">
                                            <label for="rating" class="mr-4">Note:</label>
                                            <div class="flex">
                                                <!-- Utilisation d'un tableau pour générer les étoiles dynamiquement -->
                                                <div class="rating">
                                                    <span class="star" data-value="1"></span>
                                                    <span class="star" data-value="2"></span>
                                                    <span class="star" data-value="3"></span>
                                                    <span class="star" data-value="4"></span>
                                                    <span class="star" data-value="5"></span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="rating" id="rating" value="">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="message" class="text-sm leading-7 text-gray-600 required">Message</label>
                                        <textarea id="message" name="message" class="w-full px-4 py-2 mt-2 text-base text-gray-700 bg-gray-100 border  rounded-lg focus:outline-none focus:border-gray-500 @error('message') border-red-500 @enderror" required maxlength="100" ></textarea>
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="captcha" :value="__('Captcha')" />
                                        <div class="captcha flex items-center">
                                            <span>{!! captcha_img() !!}</span>
                                            <button type="button" class="btn btn-danger ml-2" class="reload" id="reload">
                                                &#x21bb;
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="captcha_input" :value="__('Captcha Input')" />
                                        <x-text-input id="captcha_input" class="block mt-1 w-full"
                                                        type="text"
                                                        name="captcha" required />
                                        <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
                                    </div>
                                    <button class="rounded border-0 bg-indigo-500 py-2 px-6 text-lg text-white hover:bg-indigo-600 focus:outline-none">Poster</button>
                                    <p class="mt-3 text-xs text-gray-500">N'hesitez pas à nous contacter sur nos réseaux.</p>
                                </div>
                            </div>

                        </form>
                        @else
                            <div class="max-w-xl mx-auto mt-16 flex w-full flex-col rounded-lg bg-white p-8">
                                <p>Vous devez être connecté pour poster un avis. Connectez-vous !!! </p>
                                <form action="{{ route('login') }}">
                                    <button type="submit" class="rounded border-0 bg-indigo-500 py-2 px-6 text-lg text-white hover:bg-indigo-600 focus:outline-none justify-center">Se connecter</button>
                                </form>
                                <p class="mt-3 text-xs text-gray-500"></p>
                            </div>
                    @endif
                </div>
            </div>
          </div>
        </div>
    </div>
    <style>
        /* ici un petit style rapide pour mes etoiles  */
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

function openPopup() {
  document.getElementById('popup').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closePopup() {
  document.getElementById('popup').classList.add('hidden');
  document.body.style.overflow = 'auto';
}

        // Sélectionner toutes les étoiles
        const stars = document.querySelectorAll('.star');

        // Sélectionner l'élément "rating" (l'input du formulaire)
        const ratingInput = document.querySelector('#rating');

        // Initialiser la note à 0
        let rating = 0;

        // Ajouter un événement "click" pour chaque étoile
        stars.forEach((star) => {
            star.addEventListener('click', () => {
                // Mettre à jour la note en fonction de la valeur "data-value" de l'étoile cliquée
                rating = star.getAttribute('data-value');
                // Mettre à jour la valeur de l'input du formulaire avec la note sélectionnée
                ratingInput.value = rating;
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


