<template>
  <div>
    <div>
      <h2 style="display: inline">Update Employee</h2> <router-link :to="{ name: 'company.view', params: {id: `${s_employee.company_id}`}}" class="btn btn-success" style="float: right">Company Page</router-link>
    </div>
    <div class="form_container">
            <div class="error_msg" v-if="errors.value != ''">{{errors}}</div>
            <form class="form_create" @submit.prevent="saveEmployee" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" v-model="s_employee.firstname" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" v-model="s_employee.lastname" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" v-model="s_employee.email" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" v-model="s_employee.phone" required>
                </div>
                <button type="submit" class="btn_submit">Add</button>
    
            </form>

        </div>
  </div>
</template>
<script>
import useEmployee from '../composables/employee';
import { onMounted } from 'vue';

export default ({
    props: {
        id: {
            required: true,
            type: String
        }
    },
    setup(props) {

        const { errors, s_employee, getSingleEmployee, updateEmployee } = useEmployee();

        onMounted(getSingleEmployee(props.id));

        const saveEmployee = async () => {

            await updateEmployee(props.id);

        }

        return {
            errors,
            saveEmployee,
            s_employee
        }

    },

})

</script>
