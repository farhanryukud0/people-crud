<template>
    <div class='container py-4'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-header'>Detail People</div>
                    <div class='card-body'>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><span class="fa fa-user"></span></span>
                            </div>
                            <input type="text" class="form-control"  placeholder="Input Name" id="name" v-model="people.name" aria-describedby="basic-addon1" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><span class="fa fa-envelope"></span></span>
                            </div>
                            <input type="text" class="form-control"  placeholder="Email" id="email" v-model="people.email" aria-describedby="basic-addon1" disabled>
                        </div>

                        <div class='form-group'>
                            <input type="text" class="form-control"  id="phone" v-model="people.phone" aria-describedby="basic-addon1" disabled>
                        </div>
                        <div class='form-group'>
                            <router-link :to="{ name: 'home' }" class="btn btn-secondary">Back</router-link>
                        </div>
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
        }
    },
    created() {
        let uri = `/api/lihat/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.people = response.data;
        });
    },
    method: {

    }
  }
</script>
