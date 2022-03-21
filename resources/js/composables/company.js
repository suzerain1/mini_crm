import { ref } from 'vue';
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useCompany() {

    const router        = useRouter();
    const companies     = ref({value: []});
    const errors        = ref({value: ''});
    const s_company     = ref({value:[]});

    const getCompanies = async (page = 1) => {
        let res = await axios.get('/api/companies?page='+page);
        companies.value = res.data;
    }

    const getSingleCompany = async (id) => {

        let res = await axios.get('/api/companies/'+id);
        
        s_company.value = res.data;

    }

    const saveCompany = async (data) => {
        errors.value = '';
        

        try {
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let form_data = new FormData();

            form_data.append('name', data.data.name)
            form_data.append('email', data.data.email)
            form_data.append('file', data.data.logo)
            form_data.append('website', data.data.website)

            await axios.post('/api/companies', form_data, config);
            await router.push({ name: 'home.index' });

        } catch (e) {
            if(e.response.status == 422) {
                errors.value = e.response.data.message;
            }
        }

    }

    const updateCompany = async (id) => {

        errors.value = '';
        try {

            await axios.put('/api/companies/'+ id, s_company.value);
            await router.push({ name: 'home.index' });

        } catch (e) {
            if(e.response.status == 422) {
                errors.value = e.response.data.message;
            }
        }

    }

    const deleteCompany = async (id) => {
        await axios.delete('/api/companies/'+id);
    }

    return {
        s_company,
        companies,
        getCompanies,
        errors,
        saveCompany,
        getSingleCompany,
        updateCompany,
        deleteCompany
    }

}