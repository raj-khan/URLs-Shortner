<template>
    <div>
        <ValidationObserver v-slot="{ handleSubmit }" ref="form">
            <form @submit.prevent="handleSubmit(urlShort)">
                <div class="form-row">
                    <div class="col-md-8 ml-auto mb-4 mb-md-0">
                        <ValidationProvider vid="url" name="url" rules="required" v-slot="{errors}">
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-link"></i> </span>
                                </div>

                                <input name="url" type="url" v-model="url" class="form-control"
                                       placeholder="Enter your URL">
                                <div class="invalid-feedback d-block" style="font-size: 18px; color: red;">{{
                                        errors[0]
                                    }}
                                </div>
                            </div>
                        </ValidationProvider>
                    </div>
                    <div class="col-md-2 mr-auto">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Short URL</button>
                    </div>
                </div>
            </form>
        </ValidationObserver>

        <div class="container" v-if="shortUrl.success">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                <i class="fa fa-check" style="font-size: 20px; color: darkred"></i> Wow! you made your url
                                simple! 😎
                                <a href="/" class="badge badge-warning  text-right">Try another <i
                                    class="fa fa-retweet"></i></a>

                            </div>

                            <table class="table mt-3">
                                <thead>
                                <tr>
                                    <th scope="col">Given URL</th>
                                    <th scope="col">Shorted URL</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">{{shortUrl.data.url}}</th>
                                    <th scope="row">
                                        <a :href="baseUrl+'/'+shortUrl.data.hash" target="_blank">
                                            {{baseUrl+'/'+shortUrl.data.hash}}
                                        </a>

                                    </th>
                                    <th scope="row">
                                        <a :href="baseUrl+'/'+shortUrl.data.hash" target="_blank">
                                            <button type="button" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-info"><i class="fa fa-clipboard"></i></button>
                                    </th>
                                </tr>

                                </tbody>

                            </table>

                        </div>
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
            url: '',
            shortUrl: {},
            baseUrl: window.location.origin
        }
    },
    methods: {
        urlShort() {
            axios.post('/short-url', {
                url: this.url,
            }).then((res) => {
                this.shortUrl = res.data
                this.$toaster.success(res.data.message)
            }).catch((e) => {
                this.$toaster.error(e.message)
                let errUrl = e.response.data.errors.url[0];
                this.$refs.form.setErrors({
                    url: [errUrl],
                });
            })
        }
    },
    mounted() {

    }
}
</script>
