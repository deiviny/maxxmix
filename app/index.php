<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxx Mix</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="relative overflow-hidden bg-white">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 bg-white pb-8 sm:pb-16 md:pb-20 lg:w-full lg:max-w-2xl lg:pb-28 xl:pb-32">
                <svg class="absolute inset-y-0 right-0 hidden h-full w-48 translate-x-1/2 transform text-white lg:block" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div>
                    <div class="relative px-4 pt-6 sm:px-6 lg:px-8">
                        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
                            <div class="flex flex-shrink-0 flex-grow items-center lg:flex-grow-0">
                                <div class="flex w-full items-center justify-between md:w-auto">
                                    <a href="#">
                                        <span class="sr-only">Maxx Mix</span>
                                        <img alt="Maxx Mix" class="h-8 w-auto sm:h-10" src="./assets/images/logo.png">
                                    </a>
                                    <div class="-mr-2 flex items-center md:hidden">
                                        <button type="button" class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
                                            <span class="sr-only">Abrir Menu</span>
                                            <!-- Heroicon name: outline/bars-3 -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:ml-10 md:block md:space-x-8 md:pr-4">
                                <!-- <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Contato</a> -->

                                <!-- <a href="#" class="font-medium text-green-400 hover:text-indigo-500">Acessar</a> -->
                            </div>
                        </nav>
                    </div>

                    <!--
          Mobile menu, show/hide based on menu open state.

          Entering: "duration-150 ease-out"
            From: "opacity-0 scale-95"
            To: "opacity-100 scale-100"
          Leaving: "duration-100 ease-in"
            From: "opacity-100 scale-100"
            To: "opacity-0 scale-95"
        -->
                    <div class="absolute inset-x-0 top-0 z-10 origin-top-right transform p-2 transition md:hidden">
                        <div class="overflow-hidden rounded-lg bg-white shadow-md ring-1 ring-black ring-opacity-5">
                            <div class="flex items-center justify-between px-5 pt-4">
                                <div>
                                    <img class="h-8 w-auto" src="./assets/images/logo.png" alt="">
                                </div>
                                <div class="-mr-2">
                                    <button type="button" class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                        <span class="sr-only">Close main menu</span>
                                        <!-- Heroicon name: outline/x-mark -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-1 px-2 pt-2 pb-3">

                                <!-- <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Contato</a> -->
                            </div>
                            <!-- <a href="#" class="block w-full bg-gray-50 px-5 py-3 text-center font-medium text-green-300 hover:bg-gray-100">Log in</a> -->
                        </div>
                    </div>
                </div>

                <main class="mx-auto mt-10 max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Segurança e</span>
                            <span class="block text-green-400 xl:inline"> Produtividade</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mx-auto sm:mt-5 sm:max-w-xl sm:text-lg md:mt-5 md:text-xl lg:mx-0">
                            O objetivo do Maxx Mix é disponibilizar os melhores produtos para nossos clientes, aumentando sua produtividade, segurança e ganho. <br>                            
                        </p>
                        <!-- <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="https://crm.crmsimpled.com.br/" class="flex w-full items-center justify-center rounded-md border border-transparent bg-green-300 px-8 py-3 text-base font-medium text-black hover:bg-green-500 md:py-4 md:px-10 md:text-lg">Acessar</a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#" id="btn_evolua" class="flex w-full items-center justify-center rounded-md border border-transparent border-solid border-green-400 bg-white px-8 py-3 text-base font-medium text-black hover:bg-gray-100 md:py-4 md:px-10 md:text-lg">Evolua Agora!</a>
                            </div>
                        </div> -->
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:h-full lg:w-full" src="assets/images/plantacao_home.jpg" alt="">
        </div>
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <p class="mt-2 text-3xl font-bold leading-8 tracking-tight text-green-400 sm:text-4xl">Produtos</p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Temos um MIX de rodutos surpriendente com a maior qualidade e melhores preços.
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10 md:space-y-0">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-green-500 text-white">
                                <!-- Heroicon name: outline/globe-alt -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900">Sementes</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">Sementes selecionadas com garantia de um excelente plantio e uma colheita extraordinário.</dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-green-500 text-white">
                                <!-- Heroicon name: outline/scale -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>

                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900">Insumos</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">Produtos com altíssimo controle de qualidade e segurança.</dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-green-500 text-white">
                                <!-- Heroicon name: outline/bolt -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>

                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900">Milho</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">Captação constante de informações e feedbacks junto ao cliente que podem auxiliar em suas vendas.</dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-green-500 text-white">
                                <!-- Heroicon name: outline/chat-bubble-bottom-center-text -->                                
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>

                            </div>
                            <p class="ml-16 text-lg font-medium leading-6 text-gray-900">Soja</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">Sistemas automatizados de agendamento e lembretes de follow-up facilitando a vida dos vendedores e trazendo mais produtividade e resultados.</dd>
                        
                    </div>
                </dl>
            </div>
        </div>

    </div>
    <div id="div_evolua" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:h-full lg:w-full" src="assets/images/rodape.png" alt="">
            </div>
        </div>
    </div>

    


    <footer class="mx-auto mt-32 w-full max-w-container px-4 sm:px-6 lg:px-8">        
        <div class="border-t border-slate-900/5 py-10">      
            <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                <img alt="CRM Simpled" class="h-8 w-auto sm:h-10" src="./assets/images/logo.png">
            </div>
            <p class="mt-5 text-center text-sm leading-6 text-slate-500">© 2022 Simpled. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="app/js/funcoes.js"></script>
    <script src="app/js/cadastro.js"></script>
</body>
</html>