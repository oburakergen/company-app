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
       const getEmployees = computed(() => employees.value);

         const setEmployees = (data: Employee[]) => {
              employees.value = data;
         }


         const fetchEmployees = async (id: number) => {
             await api.get(`/companies/${id}`)
                 .then(data => setEmployees(data.data.data.employees))
                 .catch(err => setError({message: err.message, status: true}));
         }

            return {
                getEmployees,
                setEmployees,
                fetchEmployees
            }
    });
