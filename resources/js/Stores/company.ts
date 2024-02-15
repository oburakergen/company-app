import {computed, type Ref, ref} from 'vue'
import { createGlobalState } from '@vueuse/core'
import {Company} from "@/types";
import axios from "@/Lib/axios";
import useError from "@/Composables/useError";

const { setError } = useError();
const { api } = new axios({});
export const useCompanyState = createGlobalState(
    () => {
        const companies: Ref<Company[]> = ref([]);
        const getCompanies = computed(() => companies.value);

        const setCompanies = (data: Company[]) => {
            companies.value = data;
        }


        const fetchEmployees = async () => {
            await api.get(`/companies`)
                .then(data => setCompanies(data.data.data.employees))
                .catch(err => setError({message: err.message, status: true}));
        }
        const deleteEmployee = async (id: number) => {
            await api.delete(`/companies/${id}`)
                .then(data => setCompanies(data.data.data.employees))
                .catch(err => setError({message: err.message, status: true}));
        }
        return {
            getCompanies,
            setCompanies,
            fetchEmployees,
            deleteEmployee
        }
    });
