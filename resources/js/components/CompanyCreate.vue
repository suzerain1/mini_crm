<template>
  <div>
    <div>
      <h2 style="display: inline">Add Company</h2> <router-link :to="{ name: 'home.index' }" class="btn btn-success" style="float: right">Main Page</router-link>
    </div>
    <div class="form_container">
            <div class="error_msg" v-if="errors.value != ''">{{errors}}</div>
            <form class="form_create" @submit.prevent="storeCompany" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" v-model="form.email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" @change="handleFile" accept="image/*" required>
                    <div class="mb-3" style="color: red" v-if="!validImage">
                        Please choose a username.
                    </div>
                </div>

                <div class="mb-3" v-if="image.value != ''">
                    <img :src="image" style="height: 150px" />
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Website:</label>
                    <input type="text" class="form-control" id="website" name="website" v-model="form.website" required>
                </div>

                <button type="submit" class="btn_submit">Add</button>
    
            </form>

        </div>
  </div>
</template>
<script>
import useCompany from '../composables/company';
import { reactive, ref } from 'vue';

export default ({

    setup() {

        const form = reactive({
            'name': '',
            'email': '',
            'logo': [],
            'website': ''
        });
        const image      = ref({value:''});
        const validImage = ref({value:true});

        const handleFile = async (event) => {

            validImage.value = true;
            image.value = '';
            const target = event.target;
            
            if(target && target.files) {

                let img = new Image();
                img.src = URL.createObjectURL(target.files[0]);
                
                img.onload = () => {

                    if(img.height <= 100 || img.width <= 100) {
                        validImage.value = false;
                        event.target.value=null;
                        image.value = '';
                    }else{
                        form.logo = target.files[0];
                        image.value = URL.createObjectURL(target.files[0]);
                    }
                }
                
            }
            
        };

        const { errors, saveCompany } = useCompany();

        const storeCompany = async () => {

            await saveCompany({
                data: {...form}
            });

        }

        return {
            form,
            errors,
            storeCompany,
            handleFile,
            image,
            validImage
        }

    },

})

</script>
