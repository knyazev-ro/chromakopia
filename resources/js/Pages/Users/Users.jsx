import React, { useEffect, useMemo, useState } from 'react';
import {
  Table, TableBody, TableCell, TableContainer, TableHead,
  TableRow, Paper, TablePagination, CircularProgress,
} from '@mui/material';
import { useReactTable, getCoreRowModel, flexRender } from '@tanstack/react-table';
import axios from 'axios';
import Page from '../Layouts/Page';
import { router } from '@inertiajs/react';

export default function UserTable() {
  const [data, setData] = useState([]);
  const [total, setTotal] = useState(0);
  const [perPage, setPerPage] = useState(10);
  const [page, setPage] = useState(0);
  const [loading, setLoading] = useState(true);

  const fetchUsers = async () => {
    setLoading(true);
    try {
      const res = await axios.get(`/users`, {
        params: {
          page: page + 1,
          perPage,
        },
      });

      setData(res.data.data);
      setTotal(res.data.total);
    } catch (error) {
      console.error('Ошибка загрузки пользователей:', error);
    }
    setLoading(false);
  };

  useEffect(() => {
    fetchUsers();
  }, [page, perPage]);

  const columns = useMemo(() => [
    {
      accessorKey: 'id',
      header: 'ID',
    },
    {
      accessorKey: 'name',
      header: 'Имя',
    },
    {
      accessorKey: 'email',
      header: 'Email',
    },
    {
      accessorKey: 'branch.name',
      header: 'Филиал',
    },
    {
      accessorKey: 'sign',
      header: 'Подпись',
    },
  ], []);

  const table = useReactTable({
    data,
    columns,
    getCoreRowModel: getCoreRowModel(),
  });

  const handleChangePage = (event, newPage) => {
    setPage(newPage);
  };

  const handleChangeRowsPerPage = (event) => {
    setPerPage(parseInt(event.target.value, 10));
    setPage(0);
  };

  return (
    <Page>
    <Paper sx={{ width: '100%', overflow: 'hidden', padding: 2 }}>
        <div className='flex justify-between py-2'>
      <h2 className="text-xl font-bold text-blue-500 mb-4">Список пользователей</h2>
        <div className='bg-blue-500 p-3 text-center rounded-md text-white cursor-pointer active:bg-blue-700 hover:bg-blue-400 transition-colors'
        onClick={() => router.get(route('users.create'))}
        >Добавить пользователя</div>
        </div>

      <TableContainer>
        <Table>
          <TableHead>
            {table.getHeaderGroups().map(headerGroup => (
              <TableRow key={headerGroup.id}>
                {headerGroup.headers.map(header => (
                  <TableCell key={header.id} className="font-bold bg-sky-100 text-white">
                    {flexRender(header.column.columnDef.header, header.getContext())}
                  </TableCell>
                ))}
              </TableRow>
            ))}
          </TableHead>

          <TableBody>
            {loading ? (
              <TableRow>
                <TableCell colSpan={columns.length} align="center">
                  <CircularProgress />
                </TableCell>
              </TableRow>
            ) : (
              table.getRowModel()?.rows?.map(row => (
                <TableRow key={row.id}>
                  {row.getVisibleCells().map(cell => (
                    <TableCell key={cell.id}>
                      {flexRender(cell.column.columnDef.cell, cell.getContext())}
                    </TableCell>
                  ))}
                </TableRow>
              ))
            )}
          </TableBody>
        </Table>
      </TableContainer>

      <TablePagination
        component="div"
        count={total}
        page={page}
        onPageChange={handleChangePage}
        rowsPerPage={perPage}
        onRowsPerPageChange={handleChangeRowsPerPage}
        rowsPerPageOptions={[5, 10, 25, 50]}
      />
    </Paper>
    </Page>
  );
}
