<!-- Première partie: type de chaussure, ici on va afficher la liste des types de chaussures que nous proposons -->
<div class="col-span-1 hidden lg:block">
    <div class="full-grid h-screen">
        <div class="ml-8">
            <h1 class="font-medium max-w-xl mx-auto pt-10 pb-4">Chaussures</h1>
            <div class=" max-w-xl mx-auto 0">
                <ul class="shadow-box">
                    <li class="relative border-b border-gray-200" x-data="{selected:null}">
                        <button type="button" class="w-full px-8 py-3 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="hover:underline">
                                    Sneakers
                                </span>
                                <span class="ico-plus"></span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="px-10">
                                @foreach($list_type_chaussures as $type_chaussure)
                                {{-- un if pour trier la liste selon sa catégorie --}}
                                    @if (strpos($type_chaussure->type_chaussures, 'sneakers') !== false)
                                        <a href="{{ route('chaussures.list', ['types' => $type_chaussure->type_chaussures]) }}">
                                            <h1 class="hover:underline py-2 font-bold">{{ $type_chaussure->type_chaussures }}</h1>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li class="relative border-b border-gray-200" x-data="{selected:null}">
                        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 2 ? selected = 2 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="hover:underline">
                                    Chaussures Sport
                                </span>
                                <span class="ico-plus"></span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container2" x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                            <div class="px-10">
                                @foreach($list_type_chaussures as $type_chaussure)
                                {{-- un if pour trier la liste selon sa catégorie --}}
                                    @if (strpos($type_chaussure->type_chaussures, 'Sport') !== false)
                                        <a href="{{ route('chaussures.list', ['types' => $type_chaussure->type_chaussures]) }}">
                                            <h1 class="hover:underline py-2 font-bold">{{ $type_chaussure->type_chaussures }}</h1>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li class="relative border-b border-gray-200" x-data="{selected:null}">
                        <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="hover:underline">
                                    Bottes
                                </span>
                                <span class="ico-plus"></span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                            <div class="px-10">
                                @foreach($list_type_chaussures as $type_chaussure)
                                {{-- un if pour trier la liste selon sa catégorie --}}
                                    @if (strpos($type_chaussure->type_chaussures, 'Sport') !== false)
                                        <a href="{{ route('chaussures.list', ['types' => $type_chaussure->type_chaussures]) }}">
                                            <h1 class="hover:underline py-2 font-bold">{{ $type_chaussure->type_chaussures }}</h1>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
