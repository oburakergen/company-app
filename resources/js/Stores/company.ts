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
        const company: Ref<Company> = ref({} as Company);
        const getCompanies = computed(() => companies.value);
        const getCompany = computed(() => company.value);

        const setCompanies = (data: Company[]) => {
            companies.value = data;
        }


        const fetchCompanies = async () => {
            await api.get(`/companies`)
                .then(data => setCompanies(data.data.data))
                .catch(err => setError({message: err.message, status: true}));
        }

        const createCompany = async (data: any) => {
            console.log(data);
            await api.post(`/companies`, data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(data => setCompanies(data.data.data))
                .catch(err => setError({message: err.message, status: true}));
        }

        const updateCompany = async (id: number, data: any) => {
            await api.put(`/companies/${id}`, data, {
                headers: {
                    'Accept': 'application/json',
                    'x-www-form-urlencoded': 'multipart/form-data',
                }
            })
                .then(data => setCompanies(data.data.data))
                .catch(err => setError({message: err.message, status: true}));
        }

        const fetchCompany = async (id: number) => {
            await api.get(`/companies/${id}`)
                .then(data => company.value = data.data.data)
                .catch(err => setError({message: err.message, status: true}));
        }

        const deleteCompany = async (id: number) => {
            await api.delete(`/companies/${id}`)
                .then(data => setCompanies(data.data.data))
                .catch(err => setError({message: err.message, status: true}));
        }

        return {
            getCompanies,
            setCompanies,
            fetchCompanies,
            deleteCompany,
            getCompany,
            fetchCompany,
            createCompany,
            updateCompany
        }
    });
