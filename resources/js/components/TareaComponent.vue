<template>
    <tr>
        <td class="align-middle">{{ tarea.nombre }}</td>
        <td class="align-middle text-center">
            <span v-for="categoria in tarea.categorias" :key="categoria.id"
                class="badge badge-primary">{{ categoria.nombre }}</span>
        </td>
        <td class="align-middle text-center">
            <i @click="borrarTarea()" class="bi-x-lg text-danger" role="img"></i>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['tarea'],
        methods: {
            borrarTarea() {
                axios.delete('/api/tareas/' + this.tarea.id).then(() => {
                    this.$emit('tareaBorrada');
                });
            }
        }
    }
</script>

<style scoped>
    td {
        padding-top: 0;
        padding-bottom: 0;
    }
    .badge {
        font-size: 1em;
        margin-right: 5px;
    }
    .bi-x-lg {
        font-size: 2em;
    }
</style>