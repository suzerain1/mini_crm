import { ref } from 'vue';
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useCompany() {

    const router        = useRouter();
    const employees     = ref({value: []});
    const s_employee   = ref({value: []});
    const errors        = ref({value: ''});

    const getEmployee = async (id, page = 1) => {

        let res = await axios.get('/api/employees/comp/'+id+'?page='+page);
        
        employees.value = res.data;

    }

    const getSingleEmployee = async (id) => {

        let res = await axios.get('/api/employees/'+id);
        
        s_employee.value = res.data;

    }

    const saveEmployee = async (data) => {
        errors.value = '';
        
        try {

            await axios.post('/api/employees', data.data);
            await router.push({ name: 'company.view', params: {id: data.data.company_id}});

        } catch (e) {
            if(e.response.status == 422) {
                errors.value = e.response.data.message;
            }
        }

    }
    const updateEmployee = async (id) => {

        errors.value = '';
        try {

            await axios.put('/api/employees/'+ id, s_employee.value);
            await router.push({ name: 'company.view', params: {id: s_employee.value.company_id} });

        } catch (e) {
            if(e.response.status == 422) {
                errors.value = e.response.data.message;
            }
        }

    }

    const deleteEmployee = async (id) => {
        await axios.delete('/api/employees/'+id);
    }

    return {

        s_employee,
        employees,
        errors,
        saveEmployee,
        getEmployee,
        getSingleEmployee,
        updateEmployee,
        deleteEmployee

    }

}