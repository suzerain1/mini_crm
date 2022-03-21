<template>
  <div>
    <div>
        <img :src="`/storage/${s_company.logo}`" alt="Logo" style="height: 120px;  width: 120px;"/>
        <h3 style="display: inline">{{s_company.name}}</h3> <router-link :to="{ name: 'home.index' }" class="btn btn-success" style="float: right">Main Page</router-link>
    </div>
    <div>
        <p>Email: {{s_company.email}}</p>
        Website: <a :href="`//www.${s_company.website}`" target="_blank">{{s_company.website}}</a>
    </div><br>
    <h3>Employees</h3> <router-link :to="{ name: 'employee.create', params: {id: `${comp_id}`}}" class="btn btn-info" style="float: right">Add Employee</router-link>
    <div v-if="employees.data">
      <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in employees.data" :key="employee.id">
          <td>{{employee.id}}</td>
          <td>{{employee.firstname+' '+employee.lastname}}</td>
          <td>{{employee.email}}</td>
          <td>{{employee.phone}}</td>
          <td>
            <router-link class="btn btn-info" :to="{ name: 'employee.edit', params: {id: `${employee.id}`}}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg></router-link> | 
            <a href="#" class="btn btn-danger" @click.prevent="removeEmployee(employee.id)">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
              </svg>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Pagination -->
    <Pagination :data="employees" @pagination-change-page="getEmployee(comp_id)" />
    </div>
    <div v-else class="no_blog" style="color:red">
        <h2>No Employees yet!</h2>
    </div>

  </div>
</template>
<script>
import useCompany from '../composables/company';
import useEmployee from '../composables/employee';
import { onMounted } from 'vue';
import LaravelVuePagination from 'laravel-vue-pagination';
export default ({
  components: {
    'Pagination': LaravelVuePagination
  },
    props: {
        id: {
            required: true,
            type: String
        }
    },
    setup(props) {
        const comp_id = props.id;
        const { s_company, getSingleCompany } = useCompany();
        const { employees, getEmployee, deleteEmployee } = useEmployee();

        onMounted(getSingleCompany(props.id));
        onMounted(getEmployee(props.id));

        const removeEmployee = async (id) => {

          if(!window.confirm('Delete Company?')) {
            return
          }
          await deleteEmployee(id);
          await getSingleCompany(props.id);
          await getEmployee(props.id);

        }

        return {
            s_company,
            comp_id,
            employees,
            removeEmployee,
            getEmployee
        }
        
    },
})
</script>
