<template>
    <div class="row mt-3">
        <form v-on:submit.prevent="addTarea()" class="form-inline">
            <div class="col-md-5">
                <div class="form-group">
                    <input type="text" class="form-control" id="input-tarea" v-model="form.nombre"
                        placeholder="Nueva tarea...">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <div v-for="(categoria, index) in categorias" :key="categoria.id" class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" :id="'checkbox' + (index + 1)"
                            :value="categoria.id" v-model="form.categorias">
                        <label class="form-check-label" :for="'checkbox' + (index + 1)">{{ categoria.nombre }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block" :disabled="enAddTarea">Añadir</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categorias: [],
                form: {
                    nombre: '',
                    categorias: []
                },
                enAddTarea: false
            }
        },
        created() {
            this.getCategorias();
        },
        methods: {
            getCategorias() {
                axios.get('/api/categorias').then((res) => {
                    this.categorias = res.data;
                });
            },
            addTarea() {
                this.enAddTarea = true;
                axios.post('/api/tareas', this.form)
                    .then((res) => {
                        this.form.nombre = '';
                        this.form.categorias = [];
                        this.$emit('nuevaTarea');
                    })
                    .catch((error) => {
                        alert(JSON.stringify(error.response.data));
                    })
                    .finally(() => {
                        this.enAddTarea = false;
                    });
            }
        }
    }
</script>

<style scoped>
    .form-inline {
        width: 100%;
    }

    #input-tarea {
        width: 100%;
    }
</style>