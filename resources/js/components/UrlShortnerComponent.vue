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

    </div>
</template>

<script>
export default {
    data() {
        return {
            url: '',
            shortUrl: {}
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
