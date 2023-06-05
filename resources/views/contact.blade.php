@php
    use App\Models\Rabais;
@endphp

@extends('layout.page')

@section('content')
   <!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32">
      <div class="flex justify-center">
        <div class="text-center md:max-w-xl lg:max-w-3xl">
          <h2 class="mb-12 px-6 text-3xl font-bold">Moyens de contacts</h2>
        </div>
      </div>

      <div class="flex flex-wrap">
        <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:px-3 lg:mb-0 lg:w-5/12 lg:px-6">
            <div class="md:mb-12 lg:mb-0">
                <div class="relative h-[700px] rounded-lg shadow-lg dark:shadow-black/20">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2745.2259777899344!2d6.6181940770842465!3d46.52342997111107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c2e29933c3603%3A0xf7dc4de95e501370!2sEPSIC!5e0!3m2!1sfr!2sch!4v1685950781873!5m2!1sfr!2sch"
                        class="absolute left-0 top-0 h-full w-full rounded-lg" frameborder="0"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="w-full shrink-0 grow-0 basis-auto lg:w-7/12">
          <div class="flex flex-wrap">
            <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:w-6/12 md:px-3 lg:px-6">
              <div class="flex items-start">
                <div class="shrink-0">
                  <div class="inline-block rounded-md bg-primary-100 p-4 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" class="h-6 w-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-2.25z" />
                    </svg>
                  </div>
                </div>
                <div class="ml-6 grow">
                  <p class="mb-2 font-bold dark:text-white">
                    Support technique
                  </p>
                  <p class="text-neutral-500 dark:text-neutral-200">
                    footewearhelpDesk.gmail.com
                  </p>
                  <p class="text-neutral-500 dark:text-neutral-200">
                    021 212 12 21
                  </p>
                </div>
              </div>
            </div>
            <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:w-6/12 md:px-3 lg:px-6">
              <div class="flex items-start">
                <div class="shrink-0">
                  <div class="inline-block rounded-md bg-primary-100 p-4 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" class="h-6 w-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                  </div>
                </div>
                <div class="ml-6 grow">
                  <p class="mb-2 font-bold dark:text-white">
                    Commandes passées
                  </p>
                  <p class="text-neutral-500 dark:text-neutral-200">
                    footewearCommandes.gmail.com
                  </p>
                  <p class="text-neutral-500 dark:text-neutral-200">
                    021 313 31 13
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
  </div>
@endsection
