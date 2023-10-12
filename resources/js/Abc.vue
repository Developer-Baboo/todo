<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">TODO</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" name="Todo .." class="form-control" id="">
                            <div class="input-group-append">
                                <button class="btn btn-info tex-white">Add</button>
                            </div>
                        </div>
                        <table class="table table-bordered mt-5" >
                            <th>
                                S.NO
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Action
                            </th>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
