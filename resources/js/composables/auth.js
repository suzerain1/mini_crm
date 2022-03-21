import { ref } from 'vue';
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useAuth() {

    const user      = ref({value: []});
    const errors    = ref({value: ''});
    const router    = useRouter();

    const getUser = async (data) => {
        errors.value  = '';
        try {
            let res = await axios.post('/api/login', data.data);
            localStorage.setItem("btoken", res.data.token);

            var token_data = {
                'token': res.data.token
            }
            await axios.put('/api/storetoken/'+res.data.user.id, token_data);

            await router.push({ name: 'home.index' });
        }catch (e) {
            for (const key in e.response.data.errors) {
                errors.value += e.response.data.errors[key][0] + ' ';
            }
        }
    }

    const logout = async () => {
        try {
            await axios.post('/api/logout');
            localStorage.clear();
            await router.push({ name: 'login' });
        } catch (e) {
            for (const key in e.response.data.errors) {
                errors.value += e.response.data.errors[key][0] + ' ';
            }
        }
        
    }

    return {
        user,
        errors,
        getUser,
        logout,
    }

}