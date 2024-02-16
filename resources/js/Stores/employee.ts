import {computed, type Ref, ref} from 'vue'
import { createGlobalState } from '@vueuse/core'
import {Employee} from "@/types";
import axios from "@/Lib/axios";
import useError from "@/Composables/useError";

const { setError } = useError();
const { api } = new axios({});
export const useEmployeeState = createGlobalState(
    () => {
       const employees: Ref<Employee[]> = ref([]);
       const employee: Ref<Employee> = ref({} as Employee);
       const getEmployees = computed(() => employees.value);
        const getEmployee = computed(() => employee.value);

         const setEmployees = (data: Employee[]) => {
              employees.value = data;
         }
        const setEmployee = (data: Employee) => {
            employee.value = data;
        }


         const fetchEmployees = async (id: number) => {
             await api.get(`/companies/${id}`)
                 .then(data => setEmployees(data.data.data.employees))
                 .catch(err => setError({message: err.message, status: true}));
         }

        const fetchEmployee = async (id: number) => {
            await api.get(`/employees/${id}`)
                .then(data => setEmployee(data.data.data))
                .catch(err => setError({message: err.message, status: true}));
        }

        const updateCompany = async (id: number, data: any) => {
            await api.put(`/employees/${id}`, data, {
                headers: {
                    'Accept': 'application/json',
                }
            })
                .then(data => setEmployees(data.data.data))
                .catch(err => setError({message: err.message, status: true}));
        }

         const createEmployee = async (data: Employee) => {
                await api.post(`/employees`, data)
                    .then(data => setEmployees(data.data.data.employees))
                    .catch(err => setError({message: err.message, status: true}));
         }

         const deleteEmployee = async (id: number) => {
                await api.delete(`/employees/${id}`)
                    .then(data => setEmployees(data.data.data))
                    .catch(err => setError({message: err.message, status: true}));
         }
            return {
                getEmployees,
                setEmployees,
                fetchEmployees,
                deleteEmployee,
                updateCompany,
                createEmployee,
                getEmployee,
                fetchEmployee
            }
    });
