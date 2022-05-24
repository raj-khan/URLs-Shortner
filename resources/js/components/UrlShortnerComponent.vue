<template>
    <div>
        <form>
            <div class="form-row">
                <div class="col-md-8 ml-auto mb-4 mb-md-0">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-link"></i> </span>
                        </div>

                        <input name="link" type="url" class="form-control"
                               placeholder="Enter your URL">

                    </div>
                </div>
                <div class="col-md-2 mr-auto">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Short URL</button>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
export default {

    mounted() {

    }
}
</script>
