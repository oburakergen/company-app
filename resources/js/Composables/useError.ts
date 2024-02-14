import {computed, Ref, ref} from "vue";

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

    return {
        getError,
        setError
    }
}
