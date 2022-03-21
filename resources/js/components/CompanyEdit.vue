<template>
  <div>
    <div>
      <h2 style="display: inline">Update Company</h2> <router-link :to="{ name: 'home.index' }" class="btn btn-success" style="float: right">Main Page</router-link>
    </div>
    <div class="form_container">
            <div class="error_msg" v-if="errors.value != ''">{{errors}}</div>
            <form class="form_create" @submit.prevent="saveCompany" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" v-model="s_company.name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" v-model="s_company.email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" @change="handleFile" accept="image/*">
                    <div class="mb-3" style="color: red" v-if="!validImage">
                        Please choose a username.
                    </div>
                </div>

                <div class="mb-3" v-if="image.value != ''">
                    <img :src="image" style="height: 150px" />
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Website:</label>
                    <input type="text" class="form-control" id="website" name="website" v-model="s_company.website" required>
                </div>

                <button type="submit" class="btn_submit">Update</button>
    
            </form>

        </div>
  </div>
</template>
<script>
import useCompany from '../composables/company';
import { onMounted, ref } from 'vue';

export default ({
    props: {
        id: {
            required: true,
            type: String
        }
    },
    setup(props) {

        const image      = ref({value:''});
        const validImage = ref({value:true});

        const { s_company, getSingleCompany, updateCompany, errors } = useCompany();

        onMounted(getSingleCompany(props.id));
        
        const saveCompany = async () => {

            await updateCompany(props.id);

        }

        return {
            s_company,
            saveCompany,
            errors,
            image,
            validImage
        }

    },
})
</script>
