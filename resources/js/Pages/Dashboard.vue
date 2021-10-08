<template>
    <app-layout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                       
                        <div class="p-6">
                            <div class="flex items-center">
                                <img class="w-8 h-8 text-gray-400" src="https://www2.jps.go.cr/wp-content/uploads/2021/04/logo_nacional.png">
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Último Sorteo Loteria</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm text-gray-500">
                                    Sorteo: {{data.loteria.last.numeroSorteo}} <br>
                                    Fecha: {{getDate(data.loteria.last.fecha)}} <br>
                                    Vigencia: {{getDate(data.loteria.last.vigencia)}} <br>
                                    Primer premio: num {{data.loteria.last.premios[0].numero}} serie {{data.loteria.last.premios[0].serie}}<br>
                                    Segundo premio: num {{data.loteria.last.premios[1].numero}} serie {{data.loteria.last.premios[1].serie}}<br>
                                    Tercer premio: num {{data.loteria.last.premios[2].numero}} serie {{data.loteria.last.premios[2].serie}}<br>
                                </div>
                            </div>
                            
                        </div>

                        <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <img class="w-8 h-8 text-gray-400" src="https://www2.jps.go.cr/wp-content/uploads/2021/04/logo_chances.png">
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Último sorteo de Chances</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm text-gray-500">
                                    Sorteo: {{data.chances.last.numeroSorteo}} <br>
                                    Fecha: {{getDate(data.chances.last.fecha)}} <br>
                                    Vigencia: {{getDate(data.chances.last.vigencia)}} <br>
                                    Primer premio: num {{data.chances.last.premios[0].numero}} serie {{data.chances.last.premios[0].serie}}<br>
                                    Segundo premio: num {{data.chances.last.premios[1].numero}} serie {{data.chances.last.premios[1].serie}}<br>
                                    Tercer premio: num {{data.chances.last.premios[2].numero}} serie {{data.chances.last.premios[2].serie}}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200">
                            <LineChart title="Ultimos 9 sorteos loteria" :data="data.loteria.page.data" :labels="data.loteria.page.label"/>
                        </div>

                        <div class="p-6 border-t border-gray-200 md:border-l">
                            <LineChart title="Ultimos 9 sorteos chances" :data="data.chances.page.data" :labels="data.chances.page.label"/>
                        </div>

                        <div class="p-6 border-t border-gray-200">
                            <BarChart title="Frecuencia ultimos 1000 sorteos loteria" :data="data.loteria.page.data" :labels="data.loteria.page.label"/>
                        </div>

                        <div class="p-6 border-t border-gray-200 md:border-l">
                            <BarChart title="Frecuencia ultimos 1000 sorteos chances" :data="data.chances.page.data" :labels="data.chances.page.label"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import LineChart from '@/Pages/LineChart.vue'
    import BarChart from '@/Pages/BarChart.vue'

    export default defineComponent({
        props:['data'],
        components: {
            AppLayout,
            LineChart,
            BarChart
        },

        methods:{

            getDate(f){
                let nf = new Date(f)
                return nf.getDate() + "/" + (nf.getMonth() + 1) + "/" + nf.getFullYear()
            },
        },
    })
</script>
