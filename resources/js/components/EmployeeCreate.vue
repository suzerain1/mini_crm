<template>
  <div>
    <div>
      <h2 style="display: inline">Add Employee</h2> <router-link :to="{ name: 'company.view', params: {id: `${comp_id}`}}" class="btn btn-success" style="float: right">Main Page</router-link>
    </div>
    <div class="form_container">
            <div class="error_msg" v-if="errors.value != ''">{{errors}}</div>
            <form class="form_create" @submit.prevent="storeEmployee" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" v-model="form.firstname" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" v-model="form.lastname" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" v-model="form.email" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" v-model="form.phone" required>
                </div>

                <button type="submit" class="btn_submit">Add</button>
    
            </form>

        </div>
  </div>
</template>
<script>
import useEmployee from '../composables/employee';
import { reactive, ref } from 'vue';

export default ({
    props: {
        id: {
            required: true,
            type: String
        }
    },
    setup(props) {

        const comp_id = props.id;
        const form = reactive({
            'firstname': '',
            'lastname': '',
            'email': '',
            'phone': '',
            'company_id': props.id
        });

        const { errors, saveEmployee } = useEmployee();

        const storeEmployee = async () => {

            await saveEmployee({
                data: {...form}
            });

        }

        return {
            form,
            errors,
            storeEmployee,
            comp_id
        }

    },

})

</script>
