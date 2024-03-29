export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Employee {
    id: number;
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    created_at: string;
    updated_at: string;
    company?: Company;
    company_id?: number;
}

export interface Company {
    id: number;
    name: string;
    email?: string;
    logo?: string;
    website: string;
    slug: string;
}

export interface CompanyPagination {
    data: Company[];
    current_page: number;
    from: number;
    first_page_url: string;
    next_page_url: string;
    last_page_url: string;
    last_page: number;
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    path: string;
    per_page: number;
    prev_page_url: number | null;
    to: number;
    total: number;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
