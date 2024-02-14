import axios, { AxiosError, type AxiosInstance, type AxiosResponse } from "axios";

interface IApiClientOptions {
    baseURL?: string;
    acceptLanguage?: string;
    csrfToken?: string;
}

export default class {
    readonly instance: AxiosInstance;

    constructor(options: IApiClientOptions) {
        const baseURL = options.baseURL || "http://127.0.0.1:8000/api/";
        const timeout:number = 10000;
        const csrfToken: string = options.csrfToken ||
            document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || ""

        this.instance = axios.create({
            baseURL,
            timeout,
        });

        this.instance.interceptors.request.use(
            (req) => {
                req["headers"]["X-Requested-With"] = "XMLHttpRequest";
                if (csrfToken) {
                    req.headers["X-CSRF-TOKEN"] = csrfToken;
                    req.headers["_token"] = csrfToken;
                }
                return req;
            },
            (err: AxiosError) => Promise.reject(err),
        );
    }

    public get api(): AxiosInstance {
        return this.instance;
    }
}
