<template>
    <div class='container py-4'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-header'>Edit People</div>
                    <div class='card-body'>
                        <div class="alert alert-danger" v-if="errors.length">
                            <b>There is an error:</b>
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </div>

                        <form @submit.prevent="updatePeople">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><span class="fa fa-user"></span></span>
                                </div>
                                <input type="text" class="form-control"  placeholder="Input Name" id="name" v-model="people.name" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><span class="fa fa-envelope"></span></span>
                                </div>
                                <input type="text" class="form-control"  placeholder="Email" id="email" v-model="people.email" aria-describedby="basic-addon1">
                            </div>

                            <div class='form-group'>
                                <template>
                                    <vue-tel-input id="phone" v-model="people.phone"></vue-tel-input>
                                </template>
                            </div>
                            <div class='form-group'>
                                <router-link :to="{ name: 'home' }" class="btn btn-secondary">Back</router-link>
                                &nbsp;
                                &nbsp;
                                <button class='btn btn-primary'>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
        return {
            people:{},
            errors: [],
            name: null,
            phone: null,
            email: null,
            reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,

        }
    },
    created() {
        let uri = `/api/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.people = response.data;
        });
    },
    methods: {
        updatePeople(e){

            if (this.$data.people.name != null && this.$data.people.email != null && this.$data.people.phone != null && this.isEmailValid()) {

                let uri = `/api/ubah/${this.$route.params.id}`;
                this.axios.put(uri, this.people).then((response) => {
                    this.$swal.fire({
                        title: 'Success',
                        text: response.data.message,
                        icon: 'success',
                        timer: 1000
                    });
                    this.$router.push({name: 'home'});
                }).catch(error => {
                    let response = error.response.data;

                    if(typeof response.errors === "undefined"){
                        this.$swal.fire({
                            title: 'Something went wrong',
                            text: error.response.statusText,
                            icon: 'error',
                        })
                    }
                    else{
                        let msg = '';
                        let first = true;
                        for(let idx in response.errors){
                            if(first){
                                msg += response.errors[idx][0];
                                first = false;
                            }else{
                                msg += ", "+response.errors[idx][0];
                            }
                        }
                        this.$swal.fire({
                            title: 'Something went wrong',
                            text: msg,
                            icon: 'error',
                        })
                    }
                });
                return true;
            }


            this.errors = [];

            if (!this.people.name) {
                this.errors.push('Name cannot be empty');
            }
            if (!this.people.email) {
                this.errors.push('Email Cannot Be Empty');
            }
            if (!this.people.phone) {
                this.errors.push('Phone Cannot Be Empty');
            }
            if (!this.isEmailValid()) {
                this.errors.push('Not A Valid email');
            }

            e.preventDefault();
        }, isEmailValid: function() {
            return (this.people.email == "") ? false : (this.reg.test(this.people.email));
        }
    }
  }
</script>
