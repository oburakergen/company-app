import {computed, Ref, ref, watch} from "vue";
import { toast } from 'vue3-toastify';

interface Error {
    message: string;
    status: boolean;
}

export default function useError() {
    const error: Ref<Error> = ref({
        message: '',
        status: false
    });

    const getError = computed(() => error.value);

    const setError = (data: Error) => {
        error.value = data;
    }

    watch(getError, (value) => {
        if (value.status) {
            toast.error(value.message);
            setError({message: '', status: false});
        }
    });

    return {
        getError,
        setError
    }
}
