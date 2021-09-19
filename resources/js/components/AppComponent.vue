<template>
    <div class="container">
        <div class="row titulo mt-5">
            <h1>Gestor de tareas</h1>
        </div>
        <form-component @nuevaTarea="getTareas()"></form-component>
        <lista-tareas-component :tareas="tareas" @tareaBorrada="getTareas()"
            @nuevaTarea="getTareas()"></lista-tareas-component>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tareas: []
            }
        },
        created() {
            this.getTareas();
        },
        methods: {
            getTareas() {
                axios.get('/api/tareas').then((res) => {
                    this.tareas = res.data.data;
                });
            }
        }
    }
</script>

<style scoped>
    .titulo {
        padding-left: 15px;
        padding-right: 15px;
    }
    .titulo h1 {
        width: 100%;
        border-bottom: 2px solid black;
    }
</style>
