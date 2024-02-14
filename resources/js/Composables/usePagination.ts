import {computed} from "vue";
import {useWindowSize} from "@vueuse/core";

export default function usePagination() {
    const { width: windowWidth } = useWindowSize();

    const contentLayout = computed(() => {
        return windowWidth.value > 768 ? "default" : "mobile";
    });

    return {
        contentLayout,
    };
}
