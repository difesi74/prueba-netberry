<template>
    <div class="row lista-tareas mt-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Tarea</th>
                    <th scope="col">Categorías</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tarea-component v-for="tarea in tareas" :key="tarea.id"
                    :tarea="tarea" @tareaBorrada="actualizarLista()"></tarea-component>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['tareas'],
        methods: {
            actualizarLista() {
                this.$emit('tareaBorrada');
            }
        }
    }
</script>

<style scoped>
    .lista-tareas {
        padding-left: 15px;
        padding-right: 15px;
    }
    table th {
        background-color: #aaa;
    }
</style>