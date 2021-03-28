<template>
    <div class='container py-4'>
        <div class='row justify-content-center'>
            <div class='col-md-8'>
            <div class='card'>
                <div class='card-header'>All People</div>
                <div class='card-body'>
                    <router-link :to="{ name: 'create' }" class="btn btn-primary">Input New People</router-link>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="50" class="text-center">No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th width="200" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(people, index) in peoples.data" :key="peoples.people_id">
                                    <td width="50" class="text-center">{{ index + 1 }}</td>
                                    <td>{{ people.name }}</td>
                                    <td>{{ people.phone }}</td>
                                    <td>{{ people.email }}</td>
                                    <td width="200" class="text-center">
                                        <div class="btn-group">
                                            <router-link :to="{name: 'show', params: { id: people.people_id }}" class="btn btn-primary">Detail</router-link>
                                            <router-link :to="{name: 'edit', params: { id: people.people_id }}" class="btn btn-success">Edit</router-link>
                                            <button class="btn btn-danger" @click = "deletePeople(people.people_id)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :data="peoples" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
            </div>
        </div>
        </div>
</template>

<script>
export default {
    data() {
        return {
          peoples: {}
        }
    },
    created() {
            this.getResults();
    },
    methods: {
        getResults(page){

            let uri = 'api/daftar?page=' + page;
            this.axios.get(uri).then(response => {
                        return response.data;
                    }).then(data => {
                        this.peoples = data;
                    });
        },
        deletePeople(id)
        {
            this.$swal.fire({
                title: 'Are you sure ?',
                text: "This data will be permanently deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.value) {
                    let uri = `api/hapus/${id}`;
                    this.axios.delete(uri).then(response => {
                        this.$swal.fire({
                            title: 'Success!',
                            text: 'Data deleted successfully',
                            icon: 'success',
                            timer: 1000
                        });
                        this.peoples.data.splice(this.peoples.data.indexOf(id), 1);
                        console.log(this.peoples);
                    }).catch(error => {
                        let response = error.response;

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
                }
            })
        }
    }
  }
</script>
